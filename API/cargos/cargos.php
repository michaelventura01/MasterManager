<?php
    require_once("../model/cargo.php");

	if($_SERVER['REQUEST_METHOD']){
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Content-Type: application/json');	
	}

    function agregarCargo($descripcion,$estado){
    	$cargo = new Cargo();

    	$estados = addslashes(trim(mb_strtolower($estado)));
    	$descripciones = addslashes(trim(mb_strtolower($descripcion)));

    	$cargo->setDescripcion($descripciones);
    	$cargo->agregarCargo($estados);
    }

    function editarCargo($ids, $descripcions, $estados){
    	$cargo = new Cargo();

    	$descripcion = addslashes(trim(mb_strtolower($descripcions)));
    	$id = addslashes(trim(mb_strtolower($ids)));
    	$estado = addslashes(trim(mb_strtolower($estados)));
    	
    	$cargo->setDescripcion($descripcion);
		$cargo->setId($id);

    	$cargo->editarCargo($estado);
    }

	function desabilitarCargo($estados, $ids){
		$cargo = new Cargo();

		$estado = addslashes(trim(mb_strtolower($estados)));
		$id = addslashes(trim(mb_strtolower($ids)));
		
		$cargo->setId($id);
		$cargo->desabilitarCargo($estado);	
	}
	
	function verCargos(){
		$cargo = new Cargo();

		$cargo->verCargos();
		return $cargo->getCargos();

	}
	
	function verCargosActivos($estados){
		$cargo = new Cargo();

		$estado = addslashes(trim(mb_strtolower($estados)));

		$cargos->verCargoActivos($estado);
		return $cargo->getCargos();

	}
	
?>