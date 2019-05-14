<?php
    require_once("../model/empleado.php");

	if($_SERVER['REQUEST_METHOD']){
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Content-Type: application/json');	
	}


    function agregarEmpleadoUsuario($apellidos,$codigos,$correos,$identificacions,$nombres,$telefonos,$enlaces,$fechas,$fechaNacimientos,$tipoidentificacions,$estados,$usuarios,$claves,$rols,$areas,$cargos,$sexos){
    	$empleado = new Empleado();

    	$apellido = addslashes(trim(mb_strtolower($apellidos)));
		$codigo = addslashes(trim(mb_strtolower($codigos)));
		$correo = addslashes(trim(mb_strtolower($correos)));
		$identificacion = addslashes(trim(mb_strtolower($identificacions)));
		$nombre = addslashes(trim(mb_strtolower($nombres)));
		$telefono = addslashes(trim(mb_strtolower($telefonos)));
		$enlace = addslashes(trim(mb_strtolower($enlaces)));
		$fecha = addslashes(trim(mb_strtolower($fechas)));
		$fechaNacimiento = addslashes(trim(mb_strtolower($fechaNacimientos)));
    	$tipoidentificacion = addslashes(trim(mb_strtolower($tipoidentificacions)));
    	$estado = addslashes(trim(mb_strtolower($estados))); 
    	$usuario = addslashes(trim(mb_strtolower($usuarios))); 
    	$clave = addslashes(trim(mb_strtolower($claves))); 
    	$rol = addslashes(trim(mb_strtolower($rols))); 
    	$area = addslashes(trim(mb_strtolower($areas))); 
    	$cargo = addslashes(trim(mb_strtolower($cargos))); 
    	$sexo = addslashes(trim(mb_strtolower($sexos)));

    	$empleado->setApellido($apellido);
		$empleado->setCodigo($codigo);
		$empleado->setCorreo($correo);
		$empleado->setIdentificacion($identificacion);
		$empleado->setNombre($nombre);
		$empleado->setTelefono($telefono);
		$empleado->setEnlaceFoto($enlace);
		$empleado->setFechaInicio($fecha);
		$empleado->setFechaNacimiento($fechaNacimiento);

    	$empleado->agregarEmpleadoUsuario($tipoidentificacion,$estado, $usuario, $clave, $rol, $area, $cargo, $sexo);
    }
	
	function editarEmpleadoUsuario($apellidos,$codigos,$correos,$identificacions,$nombres,$telefonos,$enlaces,$fechas,$fechaNacimientos,$tipoidentificacions,$estados,$usuarios,$claves,$rols,$areas,$cargos,$sexos,$idAreas,$areaempleadoids,$idusuarios,$estadoinversos,$idfotos){
    	
    	$empleado = new Empleado();

    	$apellido = addslashes(trim(mb_strtolower($apellidos)));
		$codigo = addslashes(trim(mb_strtolower($codigos)));
		$correo = addslashes(trim(mb_strtolower($correos)));
		$identificacion = addslashes(trim(mb_strtolower($identificacions)));
		$nombre = addslashes(trim(mb_strtolower($nombres)));
		$telefono = addslashes(trim(mb_strtolower($telefonos)));
		$enlace = addslashes(trim(mb_strtolower($enlaces)));
		$fecha = addslashes(trim(mb_strtolower($fechas)));
		$fechaNacimiento = addslashes(trim(mb_strtolower($fechaNacimientos)));
    	$tipoidentificacion = addslashes(trim(mb_strtolower($tipoidentificacions)));
    	$estado = addslashes(trim(mb_strtolower($estados))); 
    	$usuario = addslashes(trim(mb_strtolower($usuarios))); 
    	$clave = addslashes(trim(mb_strtolower($claves))); 
    	$rol = addslashes(trim(mb_strtolower($rols))); 
    	$area = addslashes(trim(mb_strtolower($areas))); 
    	$cargo = addslashes(trim(mb_strtolower($cargos))); 
    	$sexo = addslashes(trim(mb_strtolower($sexos)));
    	$idArea = addslashes(trim(mb_strtolower($idAreas)));
    	$areaempleadoid = addslashes(trim(mb_strtolower($areaempleadoids)));
    	$idusuario = addslashes(trim(mb_strtolower($idusuarios)));
    	$estadoinverso = addslashes(trim(mb_strtolower($estadoinversos)));
    	$idfoto = addslashes(trim(mb_strtolower($idfotos)));

    	$empleado->setApellido($apellido);
		$empleado->setCodigo($codigo);
		$empleado->setCorreo($correo);
		$empleado->setIdentificacion($identificacion);
		$empleado->setNombre($nombre);
		$empleado->setTelefono($telefono);
		$empleado->setEnlaceFoto($enlace);
		$empleado->setIdFoto($idfoto);
		$empleado->setFechaInicio($fecha);
		$empleado->setFechaNacimiento($fechaNacimiento);

		$empleado->editarEmpleadoUsuario($tipoidentificacion, $usuario, $clave, $rol, $area, $idArea, $sexo, $areaempleadoid, $idusuario, $estado,$estadoinverso, $cargo);
	}


	function desactivarEmpleadoUsuario($codigos,$idfotos,$idusuarios,$estados, $estadoinversos,$fechas){
		$empleado = new Empleado();

		$codigo = addslashes(trim(mb_strtolower($codigos)));
		$idfoto = addslashes(trim(mb_strtolower($idfotos)));
		$idusuario = addslashes(trim(mb_strtolower($idusuarios)));
		$estado =  addslashes(trim(mb_strtolower($estados)));
		$estadoinverso = addslashes(trim(mb_strtolower($estadoinversos)));
		$fecha = addslashes(trim(mb_strtolower($fechas)));

		$empleado->setCodigo($codigo);
		$empleado->setIdFoto($idfoto);

		$empleado->desactivarEmpleadoUsuario($idusuario,$estado, $estadoinverso,$fecha);
	
	}

	function verEmpleados(){
		$empleado = new Empleado();
		$empleado->verEmpleados();
		return $empleado->getEmpleados();
	}
	
	function verEmpleadosActivos($estados,$areas,$facultads){
		$empleado = new Empleado();

		$estado = addslashes(trim(mb_strtolower($estados)));
		$area = addslashes(trim(mb_strtolower($areas)));
		$facultad = addslashes(trim(mb_strtolower($facultads)));


		$empleado->verEmpleadosActivos($estado, $area, $facultad);
		return $empleado->getEmpleados();
	}



?>