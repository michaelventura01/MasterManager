<?php
    require_once("../model/estado.php");
	
	
	if($_SERVER['REQUEST_METHOD']){
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Content-Type: application/json');	
	}

	
    function agregarEstado($descripcions){
    	$estado = new Estado();
    	
    	$descripcion = addslashes(trim(mb_strtolower($descripcions)));

    	$estado->setDescripcion($descripcion);
    	$estado->agregarEstado();
	}

	function editarEstado($ids,$descripcions, $estados){
		$estado = new Estado();
    	
    	$descripcion = addslashes(trim(mb_strtolower($descripcions)));
    	$id = addslashes(trim(mb_strtolower($ids)));
    	$state = addslashes(trim(mb_strtolower($estados)));


    	$estado->setEstado($state);
		$estad0->setDescripcion($descripcion);
		$estado->setId($id);
		
		$estado->editarEstado();
	}

	function desactivarEstado($ids, $estados){
		$estado = new Estado();

		$id = addslashes(trim(mb_strtolower($ids)));
    	$state = addslashes(trim(mb_strtolower($estados)));
		
		$estado->setEstado($state);
		$estado->setId($id);
		
		$estado->desactivarEstado();
	}

	function verEstados(){
		$estado = new Estado();
		$estado->verEstados();
		return $estado->getEstados();
	}

	function verEstadosActivos($estados){
		$estado = new Estado();

		$state = addslashes(trim(mb_strtolower($estados)));
		
		$estado->setEstado($state);
		
		$estado->verEstadosActivos();

		return $estado->getEstados();
	}
?>