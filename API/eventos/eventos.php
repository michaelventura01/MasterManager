<?php
    require_once("../model/evento.php");
	
	if($_SERVER['REQUEST_METHOD']){
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Content-Type: application/json');	
	}
	
	function verEventosActivos($estados, $documentos){
    	$evento = new Evento();

    	$estado = addslashes(trim(mb_strtolower($estados)));
    	$documento = addslashes(trim(mb_strtolower($documentos)));
    	
    	$evento->VerEventosActivos($estado, $documento);
    	return $evento->getEventos();
	}
?>