<?php
	require_once("../model/prioridad.php");
	
	if($_SERVER['REQUEST_METHOD']){
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Content-Type: application/json');	
	}
	
	function agregarPrioridad($descripcions, $estados){
		$prioridad = new Prioridad();

		$descripcion = addslashes(trim(mb_strtolower($descripcions)));
		$estado = addslashes(trim(mb_strtolower($estados))); 

		$prioridad->setDescripcion($descripcion);
		$prioridad->agregarPrioridad($estado);
	}

	function editarPrioridad($descripcions,$estados,$ids){
		$prioridad = new Prioridad();

		$descripcion = addslashes(trim(mb_strtolower($descripcions)));
		$estado = addslashes(trim(mb_strtolower($estados))); 
		$id = addslashes(trim(mb_strtolower($ids))); 

		$prioridad->setDescripcion($descripcion);
		$prioridad->setId($id);

		$prioridad->editarPrioridad($estado);
	}

	function desactivarPrioridad($estados,$ids){
		$prioridad = new Prioridad();

		$estado = addslashes(trim(mb_strtolower($estados))); 
		$id = addslashes(trim(mb_strtolower($ids)));
		
		$prioridad->setId($id);
		$prioridad->desactivarPrioridad($estado);
	}

	function verPrioridad(){
		$prioridad = new Prioridad();
		$prioridad->verPrioridades();
		return $prioridad->getPrioridades();
	}

	function verPrioridadesActivas(){
		$prioridad = new Prioridad();

		$estado = addslashes(trim(mb_strtolower($estados))); 

		$prioridad->verPrioridadActivas($estado);
		
		return $prioridad->getPrioridades();
	}
?>