<?php
    require_once("../model/rol.php");
	
	if($_SERVER['REQUEST_METHOD']){
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Content-Type: application/json');	
	}
	
    function agregarRol($estados, $descripcions){
    	$rol = new Rol();
    	
    	$estado = addslashes(trim(mb_strtolower($estados)));
    	$descripcion = addslashes(trim(mb_strtolower($descripcions)));
    	
    	$rol->setDescripcion($descripcion);
    	agregarRol($estado);
	}

	function editarRol($estados,$descripcions,$ids){
		$rol = new Rol();

		$estado = addslashes(trim(mb_strtolower($estados)));
    	$descripcion = addslashes(trim(mb_strtolower($descripcions)));
    	$id = addslashes(trim(mb_strtolower($ids)));

    	$rol->setDescripcion($descripcion);
    	$rol->setId($id);
		editarRol($estado);
	}

	function desactivarRol($estados,$ids){
		$rol = new Rol();

		$estado = addslashes(trim(mb_strtolower($estados)));
		$id = addslashes(trim(mb_strtolower($ids)));
		
		$rol->setId($id);
		$rol->desactivarRol($estado);
	}

	function verRoles(){
		$rol = new Rol();
		$rol->verRoles();
		return $rol->getRoles();
	}

	function verRolesActivos($estados){
		$rol = new Rol();
		
		$estado = addslashes(trim(mb_strtolower($estados)));
		
		$rol->verRolesActivos($estado);

		return $rol->getRoles();
	}	
?>