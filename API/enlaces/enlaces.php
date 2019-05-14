<?php
    require_once("../model/enlace.php");


	if($_SERVER['REQUEST_METHOD']){
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Content-Type: application/json');	
	}

	
    function agregarEnlace($nombres, $urls, $estados, $rols){
    	$enlace = new Enlace();

    	$nombre = addslashes(trim(mb_strtolower($nombres)));
    	$url = addslashes(trim(mb_strtolower($urls)));
    	$estado = addslashes(trim(mb_strtolower($estados)));
    	$rol = addslashes(trim(mb_strtolower($rols)));

    	$enlace->setNombre($nombre);
		$enlace->setUrl($url);
    	$enlace->agregarEnlace($estado, $rol);
	}
	
	function editarEnlace($idenlacerols,$estados,$rols,$ids,$nombres,$urls){
		$enlace = new Enlace();

		$idenlacerol = addslashes(trim(mb_strtolower($idenlacerols)));
		$estado = addslashes(trim(mb_strtolower($estados)));
		$rol = addslashes(trim(mb_strtolower($rols)));
		$id = addslashes(trim(mb_strtolower($ids)));
		$nombre = addslashes(trim(mb_strtolower($nombres)));
		$url = addslashes(trim(mb_strtolower($urls)));


		$enlace->setId($id);
		$enlace->setNombre($nombre);
		$enlace->setUrl($url);

		$enlace->editarEnlace($id, $idenlacerol,$nombre, $url, $estado, $rol);
	}
	
	function desactivarEnlace($ids, $estados){
		$enlace = new Enlace();
		$id = addslashes(trim(mb_strtolower($ids)));
		$estado = addslashes(trim(mb_strtolower($estados)));

		$enlace->setId($id);

		$enlace->desactivarEnlace($estado);
	}

	function verEnlace(){
		$enlace = new Enlace();
		$enlace->verEnlaces();
		return $enlace->getEnlaces();
	}
	
	function verEnlaceActivo($estados){
		$enlace = new Enlace();
		
		$estado = addslashes(trim(mb_strtolower($estados)));
		
		$enlace->verEnlaceActivos($estado); 

		return $enlace->getEnlaces();
	}
?>