<?php
    require_once("../model/sexo.php");
	
	if($_SERVER['REQUEST_METHOD']){
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Content-Type: application/json');	
	}

	
    function agregarSexo($estados, $descripcions){
    	$sexo = new Sexo();

    	$estado = addslashes(trim(mb_strtolower($estados)));
    	$descripcion = addslashes(trim(mb_strtolower($descripcions)));
    	
    	$sexo->setDescripcion($descripcion);
    	$sexo->agregarSexo($estado);
	}

	function editarSexo($estados,$descripcions,$ids){
		$sexo = new Sexo();

		$estado = addslashes(trim(mb_strtolower($estados)));
    	$descripcion = addslashes(trim(mb_strtolower($descripcions)));
    	$id = addslashes(trim(mb_strtolower($ids)));

    	$sexo->setDescripcion($descripcion);
    	$sexo->setId($id);
		$sexo->editarSexo($estado);
	}

	function desactivarSexo($estados,$ids){
		$sexo = new Sexo();
		$estado = addslashes(trim(mb_strtolower($estados)));
		$id = addslashes(trim(mb_strtolower($ids)));
		
		$sexo->setId($id);
		$sexo->desactivarSexo($estado);
	}

	function verSexos(){
		$sexo = new Sexo();
		$sexo->verSexos();
		return $sexo->getSexos();
	}

	function verSexosActivos($estados){
		$sexo = new Sexo();
		$estado = addslashes(trim(mb_strtolower($estados)));
		$sexo->verSexosActivos($estado);
		return $sexo->getSexos();
	}
?>