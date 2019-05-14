<?php
    require_once("../model/area.php"); 

    if($_SERVER['REQUEST_METHOD']){
		header("Access-Control-Allow-Origin: *");
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Content-Type: application/json');	
	}

    function agregarArea($id, $nombre, $fecha, $facultad, $estado ){
    	$area = new Area();


    	$area->setId(addslashes(trim(mb_strtolower($id))));
		$area->setNombre(addslashes(trim(mb_strtolower($nombre))));
		$area->setFechaInicio(addslashes(trim(mb_strtolower($fecha))));

    	$area->agregarArea(addslashes(trim(mb_strtolower($facultad))), addslashes(trim(mb_strtolower($estado))));
    }
	
	function editarArea($id, $nombre, $facultad, $estado, $idarea, $estadoin){
		$area = new Area();
		$area->setId(addslashes(trim(mb_strtolower($id))));
		$area->setNombre(addslashes(trim(mb_strtolower($nombre))));
		
		$area->editarArea(addslashes(trim(mb_strtolower($facultad))), addslashes(trim(mb_strtolower($estado))), addslashes(trim(mb_strtolower($idarea))), addslashes(trim(mb_strtolower($estadoin))));
	}    

	function desactivarArea($fechafin,$estado, $idarea, $estadoin){
		$area = new Area();
		$area->setFechaFin(addslashes(trim(mb_strtolower($fechafin))));
		$area->desactivarArea(addslashes(trim(mb_strtolower($estado))), addslashes(trim(mb_strtolower($idarea))), addslashes(trim(mb_strtolower($estadoin))));
	}  

	function verAreas(){
		$area = new Area();
		$area->verAreas();

		return $area->getAreas();
	}  

	function verAreasActivas($estado, $facultad){
		$area = new Area();
		$area->verAreasActivas(addslashes(trim(mb_strtolower($estado))), addslashes(trim(mb_strtolower($facultad))));

		return $area->getAreas();
	}

	function verAreasEmpleados(){
		$area = new Area();
	    $area->verAreasEmpleados();

	    return $area->getAreas();
	}

	function verAreaEmpleadosFiltro($estado, $facultad){
		$area = new Area();
		$area->verAreasEmpleadosFiltro(addslashes(trim(mb_strtolower($estado))), addslashes(trim(mb_strtolower($facultad))));

		return $area->getAreas();
	}

	    
?>