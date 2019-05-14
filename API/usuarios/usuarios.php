<?php
    require_once("../model/usuario.php");
	
	if($_SERVER['REQUEST_METHOD']){
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Content-Type: application/json');	
	}
	
	function verUsuarios(){
    	$usuario = new Usuario();
    	$usuario->verUsuarios();
    	return $usuario->getUsuarios();
	}

	function verUsuarioActivo($estados,$areas){
		$usuario = new Usuario();

		$estado = addslashes(trim(mb_strtolower($estados)));
    	$area = addslashes(trim(mb_strtolower($areas)));
		
		$usuario->verUsuariosActivos($area, $estado);
		return $usuario->getUsuarios();
	}

	function verUsuario($estados,$usuarios,$claves){
		$usuario = new Usuario();

		$estado = addslashes(trim(mb_strtolower($estados)));
		$user = addslashes(trim(mb_strtolower($usuarios)));
		$clave = addslashes(trim(mb_strtolower($claves)));

		$usuario->setUsuario($user);

		$usuario->setClave($clave);

		$usuario->verUsuario($estado);

		return $usuario->getUsuarios();
	}
?>