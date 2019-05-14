<?php
    include_once("conexion.php");
    include_once("estado.php");
    include_once("facultad.php");
 
    class Area extends conexion{
        private $id;
        private $nombre;
        private $fechaInicio;
        private $fechaFin;
        

        private $areas;
        
        //relacion
        private $estados;
        private $facultades;

        function __construct(){
			parent::__construct();

			$this->id = 0;
            $this->nombre = '';
            $this->areas = '';
            $this->fechaInicio = '';
            $this->fechaFin = '';
        }

        public function getAreas(){
            return $this->areas;
        }

        public function getId(){
            return $this->id;
        }
        public function getNombre(){
            return $this->$nombre;
        }

        public function getFechaInicio(){
            return $this->fechaInicio;
        }
        public function getFechaFin(){
            return $this->fechaFin;
        }

        public function setId($id){
            $this->id = $id;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setFechaInicio($fecha){
            $this->fechaInicio = $fecha;
        }
        public function setFechaFin($fecha){
            $this->fechaFin = $fecha;
        }

        public function agregarArea($nombrefacultad, $nombreestado){
            $facultades = new Facultad();
            $facultades->setNombre($nombrefacultad);

            $estados = new Estado();
            $estados->setDescripcion($nombreestado);

            $this->conectar();
            $this->query = "call agregarArea('$this->nombre', '$this->id', '$facultades->getNombre()', '$estados->getDescripcion()', '$this->fechaInicio');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }
        
        public function editarArea($nombrefacultad, $nombreestado, $idarea, $estadoin){
            $facultades = new Facultad();
            $facultades->setNombre($nombrefacultad);

            $estados = new Estado();
            $estados->setDescripcion($nombreestado);

            $this->conectar();
            $this->query = "call editarArea('$this->id', '$this->nombre', '$facultades->getNombre()', '$estados->getDescripcion()', '$idarea, $estadoin');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }
            
        public function desactivarArea($nombreestado, $idarea, $estadoin){
            $facultades = new Facultad();
            $facultades->setId($idarea);

            $estados = new Estado();
            $estados->setDescripcion($nombreestado);

            $this->conectar();
            $this->query = "call desactivarArea('$estados->getDescripcion()', '$facultades->getId()', '$this->fechaFin', '$estadoin');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function verAreas(){
            $this->conectar();

			$this->query = "SELECT 
                                area.`idArea` 'idarea',
                                area.`nombreArea` 'nombrearea',
                                facultad.idFacultad 'idfacultad',
                                facultad.nombreFacultad 'nombrefacultad'
                            FROM `AREAS`as area
                            inner join FACULTADES facultad on area.idFacultad = facultad.idFacultad ";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->areas = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'idarea' => $fila['idarea'],
                    'nombrearea' => $fila['nombrearea'],
                    'idfacultad' => $fila['idfacultad'],
                    'nombrefacultad' => $fila['nombrefacultad']
				);

				array_push($this->areas, $arreglo);
			}
			$this->desconectar();
        }

        public function verAreasActivas($estado, $facultad){

            $estados = new Estado();
            $estados->setDescripcion($estado);

            $facultades = new Facultad();
            $facultades->setNombre($facultad); 

            $this->conectar();

			$this->query = "SELECT 
                                area.`idArea` 'idarea',
                                area.`nombreArea` 'nombrearea',
                                facultad.idFacultad 'idfacultad',
                                facultad.nombreFacultad 'nombrefacultad'
                            FROM `AREAS`as area
                            inner join FACULTADES facultad on area.idFacultad = facultad.idFacultad
                            inner join ESTADOS estado on area.idEstado = estado.idEstado
                            WHERE area.idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = '$estados->getDescripcion()')
                            AND area.idFacultad = (SELECT idFacultad FROM FACULTADES WHERE nombreFacultad = '$facultades->setNombre()')";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->areas = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'idarea' => $fila['idarea'],
                    'nombrearea' => $fila['nombrearea'],
                    'idfacultad' => $fila['idfacultad'],
                    'nombrefacultad' => $fila['nombrefacultad']
				);

				array_push($this->areas, $arreglo);
			}
			$this->desconectar();

        }

        public function verAreasEmpleados(){

            $this->conectar();

			$this->query = "SELECT 
                                areaemp.`idAreaEmpleado` 'id',
                                area.`idArea` 'idarea',
                                area.nombreArea 'nombrearea',
                                facultad.idFacultad 'idfacultad',
                                facultad.nombreFacultad 'nombrefacultad',
                                empleado.`codigoEmpleado` 'codigoempleado',
                                empleado.nombreEmpleado 'nombreempleado',
                                empleado.apellidoEmpleado 'apellidoempleado',
                                empleado.identificacionEmpleado 'identificacionempleado',
                                empleado.fechaEntrada 'fechaentrada',
                                empleado.correoEmpleado 'correoempleado',
                                empleado.telefonoEmpleado 'telefonoempleado',
                                identificion.descripcionIdentificacion 'tipoidentificacion',
                                cargo.`idCargo` 'idcargo',
                                cargo.descripcionCargo 'nombrecargo',
                                areaemp.`idEstado`'idestado',
                                estado.descripcionEstado 'nombreestado'
                            FROM `AREAEMPLEADOS` as areaemp
                            inner join EMPLEADOS as empleado on areaemp.codigoEmpleado = empleado.codigoEmpleado
                            inner join AREAS as area on areaemp.idArea = area.idArea
                            inner join FACULTADES as facultad on area.idFacultad = facultad.idFacultad
                            inner join CARGOS as cargo on areaemp.idCargo = cargo.idCargo
                            inner join ESTADOS as estado on areaemp.idEstado = estado.idEstado
                            inner join IDENTIFICACIONES as identificion on empleado.idIdentificacion = identificion.idIdentificacion";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->areas = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
                    'id' => $fila['id'],
                    'idarea' => $fila['idarea'],
                    'nombrearea' => $fila['nombrearea'],
                    'idfacultad' => $fila['idfacultad'],
                    'nombrefacultad' => $fila['nombrefacultad'],
                    'codigoempleado' => $fila['codigoempleado'],
                    'nombreempleado' => $fila['nombreempleado'],
                    'apellidoempleado' => $fila['apellidoempleado'],
                    'identificacionempleado' => $fila['identificacionempleado'],
                    'fechaentrada' => $fila['fechaentrada'],
                    'correoempleado' => $fila['correoempleado'],
                    'telefonoempleado' => $fila['telefonoempleado'],
                    'tipoidentificacion' => $fila['tipoidentificacion'],
                    'idcargo' => $fila['idcargo'],
                    'nombrecargo' => $fila['nombrecargo'],
                    'idestado' => $fila['idestado'],
                    'nombreestado' => $fila['nombreestado']
				);

				array_push($this->areas, $arreglo);
			}
			$this->desconectar();

        }

        public function verAreasEmpleadosFiltro($estado, $facultad){

            $estados = new Estado();
            $estados->setDescripcion($estado);

            $facultades = new Facultad();
            $facultades->setNombre($facultad); 

            $this->conectar();

			$this->query = "SELECT 
                                areaemp.`idAreaEmpleado` 'id',
                                area.`idArea` 'idarea',
                                area.nombreArea 'nombrearea',
                                facultad.idFacultad 'idfacultad',
                                facultad.nombreFacultad 'nombrefacultad',
                                empleado.`codigoEmpleado` 'codigoempleado',
                                empleado.nombreEmpleado 'nombreempleado',
                                empleado.apellidoEmpleado 'apellidoempleado',
                                empleado.identificacionEmpleado 'identificacionempleado',
                                empleado.fechaEntrada 'fechaentrada',
                                empleado.correoEmpleado 'correoempleado',
                                empleado.telefonoEmpleado 'telefonoempleado',
                                identificion.descripcionIdentificacion 'tipoidentificacion',
                                cargo.`idCargo` 'idcargo',
                                cargo.descripcionCargo 'nombrecargo',
                                areaemp.`idEstado`'idestado',
                                estado.descripcionEstado 'nombreestado'
                            FROM `AREAEMPLEADOS` as areaemp
                            inner join EMPLEADOS as empleado on areaemp.codigoEmpleado = empleado.codigoEmpleado
                            inner join AREAS as area on areaemp.idArea = area.idArea
                            inner join FACULTADES as facultad on area.idFacultad = facultad.idFacultad
                            inner join CARGOS as cargo on areaemp.idCargo = cargo.idCargo
                            inner join ESTADOS as estado on areaemp.idEstado = estado.idEstado
                            inner join IDENTIFICACIONES as identificion on empleado.idIdentificacion = identificion.idIdentificacion
                            WHERE 
                                areaemp.idEstado = (SELECT idEstado from ESTADOS WHERE descripcionEstado = '$estados->getDescripcion()')
                            AND facultad.nombreFacultad = '$facultades->getNombre()'";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->areas = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
                    'id' => $fila['id'],
                    'idarea' => $fila['idarea'],
                    'nombrearea' => $fila['nombrearea'],
                    'idfacultad' => $fila['idfacultad'],
                    'nombrefacultad' => $fila['nombrefacultad'],
                    'codigoempleado' => $fila['codigoempleado'],
                    'nombreempleado' => $fila['nombreempleado'],
                    'apellidoempleado' => $fila['apellidoempleado'],
                    'identificacionempleado' => $fila['identificacionempleado'],
                    'fechaentrada' => $fila['fechaentrada'],
                    'correoempleado' => $fila['correoempleado'],
                    'telefonoempleado' => $fila['telefonoempleado'],
                    'tipoidentificacion' => $fila['tipoidentificacion'],
                    'idcargo' => $fila['idcargo'],
                    'nombrecargo' => $fila['nombrecargo'],
                    'idestado' => $fila['idestado'],
                    'nombreestado' => $fila['nombreestado']
				);

				array_push($this->areas, $arreglo);
			}
			$this->desconectar();
            
        }

    }
?>