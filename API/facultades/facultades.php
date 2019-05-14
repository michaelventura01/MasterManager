<?php
    require_once("../model/facultad.php");
	
	if($_SERVER['REQUEST_METHOD']){
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Content-Type: application/json');	
	}
	
	function agregarConfiguracionFacultad($enlaces,$ids,$nombres,$correos,$direccions,$telefonos,$fechas,$empleados,$areas,$cargos,$idareaempleados,$estados){
    	
    	$facultad = new Facultad();

    	$enlace = addslashes(trim(mb_strtolower($enlaces)));
		$id = addslashes(trim(mb_strtolower($ids)));
		$nombre = addslashes(trim(mb_strtolower($nombres)));
		$correo = addslashes(trim(mb_strtolower($correos)));
		$direccion = addslashes(trim(mb_strtolower($direccions)));
		$telefono = addslashes(trim(mb_strtolower($telefonos)));
		$fecha = addslashes(trim(mb_strtolower($fechas)));
    	$empleado = addslashes(trim(mb_strtolower($empleados)));
    	$area = addslashes(trim(mb_strtolower($areas)));
    	$cargo = addslashes(trim(mb_strtolower($cargos)));
    	$idareaempleado = addslashes(trim(mb_strtolower($idareaempleados)));
    	$estado = addslashes(trim(mb_strtolower($estados)));

    	$facultad->setEnlaceFoto($enlace);
		$facultad->setId($id);
		$facultad->setNombre($nombre);
		$facultad->setCorreo($correo);
		$facultad->setDireccion($direccion);
		$facultad->setTelefono($telefono);
		$facultad->setFechaInicio($fecha);
    	$facultad->agregarConfiguracionFacultad($empleado, $area, $cargo, $idareaempleado, $estado);
	}

	function editarConfiguracionFacultad($enlaces,$ids,$nombres,$correos,$direccions,$telefonos,$fechas,$idfacultads,$empleados,$areas,$cargos,$idareaempleados,$estados){

		$facultad = new Facultad();

		$enlace = addslashes(trim(mb_strtolower($enlaces)));
		$id = addslashes(trim(mb_strtolower($ids)));
		$nombre = addslashes(trim(mb_strtolower($nombres)));
		$correo = addslashes(trim(mb_strtolower($correos)));
		$direccion = addslashes(trim(mb_strtolower($direccions)));
		$telefono = addslashes(trim(mb_strtolower($telefonos)));
		$fecha = addslashes(trim(mb_strtolower($fechas)));
		$idfacultad = addslashes(trim(mb_strtolower($idfacultads))); 
		$empleado = addslashes(trim(mb_strtolower($empleados)));  
		$area = addslashes(trim(mb_strtolower($areas)));  
		$cargo = addslashes(trim(mb_strtolower($cargos)));  
		$idareaempleado = addslashes(trim(mb_strtolower($idareaempleados)));  
		$estado = addslashes(trim(mb_strtolower($estados))); 

		$facultad->setEnlaceFoto($enlace);
		$facultad->setId($id);
		$facultad->setNombre($nombre);
		$facultad->setCorreo($correo);
		$facultad->setDireccion($direccion);
		$facultad->setTelefono($telefono);
		$facultad->setFechaInicio($fecha);

		$facultad->editarConfiguracionFacultad($idfacultad, $empleado, $area, $cargo, $idareaempleado, $estado);
	}

	function desactivarConfiguracionFacultad($enlaces,$estados,$idareaempleados){
		$facultad = new Facultad();

		$id = addslashes(trim(mb_strtolower($enlaces)));
		$estado = addslashes(trim(mb_strtolower($estados)));
		$idareaempleado = addslashes(trim(mb_strtolower($idareaempleados)));

		$facultad->setId($id);
		$facultad->desactivarConfiguracionFacultad($estado, $idareaempleado);
	}

	function verFacultad(){
		$facultad = new Facultad();
		$facultad->verFacultades();
		return $facultad->getFacultades();
	}

	function verFacultadesActivas($estados){
		$facultad = new Facultad();
		
		$estado = addslashes(trim(mb_strtolower($estados))); 
		
		$facultad->verFacultadesActivas($estado);
		
		return $facultad->getFacultades();
	}
?>