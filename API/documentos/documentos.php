<?php
    require_once("../model/documento.php");
	
	if($_SERVER['REQUEST_METHOD']){
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Content-Type: application/json');	
	}
	

    function agregarTipoDocumento($descripcions, $estados){
    	$documento = new Documento();

    	$descripcion = addslashes(trim(mb_strtolower($descripcions)));
    	$estado = addslashes(trim(mb_strtolower($estados)));

    	$documento->setDescripcionTipoDocumento($descripcion);
    	$documento->agregarTipoDocumento($estado);
	}
	
	function editarTipoDocumento($ids, $descripcions, $estados){
		$documento = new Documento();

		$descripcion = addslashes(trim(mb_strtolower($descripcions)));
    	$estado = addslashes(trim(mb_strtolower($estados)));
    	$id = addslashes(trim(mb_strtolower($ids)));

    	$documento->setIdTipoDocumento($id);
		$documento->setDescripcionTipoDocumento($descripcion);

		$documento->editarTipoDocumento($estado);
	}
	
	function desactivarTipoDocumento($ids, $estados){
		$documento = new Documento();

		$estado = addslashes(trim(mb_strtolower($estados)));
    	$id = addslashes(trim(mb_strtolower($ids)));

    	$documento->setIdTipoDocumento($id);

		$documento->desactivarTipoDocumento($estado);
	}
	
	function verTipoDocumento(){
		$documento = new Documento();

		$documento->verTipoDocumentos();

		return $documento->getTipoDocumentos();
	}
	
	function verTipoDocumentoActivo($estados){
		$documento = new Documento();
		
		$estado = addslashes(trim(mb_strtolower($estados)));
		
		$documento->verTipoDocumentosActivos($estado);
		return $documento->getTipoDocumentos();
	}
	
	function agregarDocumento($ids, $fechas, $horas, $descripcions, $tipodescripcions, $areas, $vias, $empleados, $prioridads, $estados){
		
		$documento = new Documento();

		$id = addslashes(trim(mb_strtolower($ids)));
		$fecha = addslashes(trim(mb_strtolower($fechas)));
		$hora = addslashes(trim(mb_strtolower($horas)));
		$descripcion = addslashes(trim(mb_strtolower($descripcions)));
		$tipodescripcion = addslashes(trim(mb_strtolower($tipodescripcions)));
		$area = addslashes(trim(mb_strtolower($areas)));
		$areavia = addslashes(trim(mb_strtolower($vias)));
		$empleado = addslashes(trim(mb_strtolower($empleados)));
		$prioridad = addslashes(trim(mb_strtolower($prioridads)));
		$estado = addslashes(trim(mb_strtolower($estados)));

		$documento->setId($id);
		$documento->setFecha($fecha);
		$documento->setHora($hora);
		$documento->setDescripcion($descripcion);
		$documento->setDescripcionTipoDocumento($tipodescripcion);
		

		$documento->agregarDocumento($area, $areavia, $empleado, $prioridad, $estado);
	}
	
	function editarDocumento($ids,$fechas,$horas,$descripcions,$tipodescripcions, $iddocumentos, $areas, $estados, $areavias, $empleados, $prioridads){
		$documento = new Documento();

		$id = addslashes(trim(mb_strtolower($ids)));
		$fecha = addslashes(trim(mb_strtolower($fechas)));
		$hora = addslashes(trim(mb_strtolower($horas)));
		$descripcion = addslashes(trim(mb_strtolower($descripcions)));
		$tipodescripcion = addslashes(trim(mb_strtolower($tipodescripcions)));
		$iddocumento = addslashes(trim(mb_strtolower($iddocumentos)));
		$area = addslashes(trim(mb_strtolower($areas)));
		$estado  = addslashes(trim(mb_strtolower($estados)));
		$areavia  = addslashes(trim(mb_strtolower($areavias)));
		$empleado  = addslashes(trim(mb_strtolower($empleados)));
		$prioridad = addslashes(trim(mb_strtolower($prioridads)));

		$documento->setId($id);
		$documento->setFecha($fecha);
		$documento->setHora($hora);
		$documento->setDescripcion($descripcion);
		$documento->setDescripcionTipoDocumento($tipodescripcion);
		
		$documento->editarDocumento($iddocumento, $area, $estado, $areavia, $empleado, $prioridad);	
	}
	
	function desactivarDocumento($ids, $estados){
		$documento = new Documento();

		$id = addslashes(trim(mb_strtolower($ids)));
		$estado  = addslashes(trim(mb_strtolower($estados)));

		$documento->setId($id);
		
		$documento->desactivarDocumento($estado);	
	}
	
	function agregarDocumentoEvento($ids,$fechas,$horas,$descripcions,$tipodescripcions,$descripcionEventos, $idEventos, $areas, $estados, $areavias, $empleados, $estadoins,$prioridads){
		
		$documento = new Documento();

		$id = addslashes(trim(mb_strtolower($ids)));
		$fecha = addslashes(trim(mb_strtolower($fechas)));
		$hora = addslashes(trim(mb_strtolower($horas)));
		$descripcion = addslashes(trim(mb_strtolower($descripcions)));
		$tipodescripcion = addslashes(trim(mb_strtolower($tipodescripcions)));
		$descripcionEvento  = addslashes(trim(mb_strtolower($descripcionEventos)));
		$idEvento = addslashes(trim(mb_strtolower($idEventos)));
		$area = addslashes(trim(mb_strtolower($areas)));
		$estado = addslashes(trim(mb_strtolower($estados)));
		$areavia = addslashes(trim(mb_strtolower($areavias)));
		$empleado = addslashes(trim(mb_strtolower($empleados)));
		$estadoin = addslashes(trim(mb_strtolower($estadoins)));
		$prioridad = addslashes(trim(mb_strtolower($prioridads)));

		$documento->setId($id);
		$documento->setFecha($fecha);
		$documento->setHora($hora);
		$documento->setDescripcion($descripcion);
		$documento->setDescripcionTipoDocumento($tipodescripcion);

		$documento->documentoEventoAgregar($descripcionEvento, $idEvento, $area, $estado, $areavia, $empleado, $estadoin, $prioridad);	
	}
	
	function editarDocumentoEvento($ids,$fechas,$horas,$descripcions,$tipodescripcions,$idanteriors,$descripcionEventos,$idEventos,$areas,$estados,$areavias,$empleados,$prioridads ){
		$documento = new Documento();

		$id = addslashes(trim(mb_strtolower($ids)));
		$fecha = addslashes(trim(mb_strtolower($fechas)));
		$hora = addslashes(trim(mb_strtolower($horas)));
		$descripcion = addslashes(trim(mb_strtolower($descripcions)));
		$tipodescripcion = addslashes(trim(mb_strtolower($tipodescripcions)));
		$idanterior = addslashes(trim(mb_strtolower($idanteriors)));
		$descripcionEvento = addslashes(trim(mb_strtolower($descripcionEventos)));
		$idEvento = addslashes(trim(mb_strtolower($idEventos)));
		$area = addslashes(trim(mb_strtolower($areas)));
		$estado = addslashes(trim(mb_strtolower($estados)));
		$areavia = addslashes(trim(mb_strtolower($areavias))); 
		$empleado = addslashes(trim(mb_strtolower($empleados))); 
		$prioridad = addslashes(trim(mb_strtolower($prioridads)));

		$documento->setId($id);
		$documento->setFecha($fecha);
		$documento->setHora($hora);
		$documento->setDescripcion($descripcion);
		$documento->setDescripcionTipoDocumento($tipodescripcion);

		$documento->documentoEventoEditar($idanterior, $descripcionEvento, $idEvento, $area, $estado, $areavia, $empleado, $prioridad);	
	}
	
	function verDocumentoEvento(){
		$documento = new Documento();
		$documento->verDocumentos();
		return $documento->getDocumentos();
	}
	
	function verDocumentoEventoActivo($estados, $areas){
		$documento = new Documento();

		$estado = addslashes(trim(mb_strtolower($estados)));
		$area = addslashes(trim(mb_strtolower($areas)));

		$documento->verDocumentosFiltro($estado, $area);
		return $documento->getDocumentos();	
	}
	
?>