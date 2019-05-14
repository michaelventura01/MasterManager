<?php
    require_once("../model/identificacion.php");


	if($_SERVER['REQUEST_METHOD']){
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Content-Type: application/json');	
	}

	
    function agregarIdentificacion($descripcions,$estados){
    	$identificacion = new Identificacion();
    	
    	$descripcion = addslashes(trim(mb_strtolower($descripcions))); 
    	$estado = addslashes(trim(mb_strtolower($estados)));

    	$identificacion->setDescripcion($descripcion);
    	$identificacion->agregarIdentificacion($estado);
	}

	function editarIdentificacion($descripcions,$estados,$ids){
		$identificacion = new Identificacion();

		$descripcion = addslashes(trim(mb_strtolower($descripcions))); 
    	$estado = addslashes(trim(mb_strtolower($estados)));
		$id = addslashes(trim(mb_strtolower($ids)));


		$identificacion->setId($id);
		$identificacion->setDescripcion($descripcion);
		$identificacion->editarIdentificacion($estado);
	}

	function desactivarIdentificacion($estados,$ids){
		$identificacion = new Identificacion();

		$estado = addslashes(trim(mb_strtolower($estados)));
		$id = addslashes(trim(mb_strtolower($ids)));
		
		$identificacion->setId($id);
		$identificacion->desactivarIdentificacion($estado);
	}

	function verIdentificaciones(){
		$identificacion = new Identificacion();
		$identificacion->verIdentificaciones();
		return $identificacion->getIdentificaciones();
	}

	function verIdentificacionesActivos($estados){
		$identificacion = new Identificacion();
		
		$estado = addslashes(trim(mb_strtolower($estados)));
		
		$identificacion->verIdentificacionActivos($estado);
		
		return $identificacion->getIdentificaciones();
	}
?>