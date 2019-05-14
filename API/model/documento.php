<?php
    require_once("conexion.php");
    require_once("estado.php");
    require_once("area.php");
    require_once("empleado.php");
    require_once("prioridad.php");
    require_once("evento.php");
 
    class Documento extends Conexion{

        private $idTipoDocumento;
        private $descripcionTipoDocumento;
        private $id;
        private $fecha;	
        private $hora;	
        private $descripcion;	
        
        private $documentos;
        private $tipoDocumentos;

        //relacion
        private $areas;
        private $estados;
        private $empleados;
        private $prioridades;
        private $eventos;

        function __construct(){
			parent::__construct();

			$this->idTipoDocumento = 0;
            $this->descripcionTipoDocumento = '';
            $this->id = 0;
            $this->fecha = '';	
            $this->hora = '';	
            $this->descripcion = '';
            $this->documentos = '';
            $this->tipoDocumentos = '';
        }

        public function getId(){
            return $this->id;
        }
        public function getFecha(){
            return $this->fecha;
        }	
        public function getHora(){
            return $this->hora;
        }	
        public function getDescripcion(){
            return $this->descripcion;
        }

        public function getIdTipoDocumento(){
            return $this->idTipoDocumento;
        }
        
        public function getDescripcionTipoDocumento(){
            return $this->descripcionTipoDocumento;
        }

        public function getDocumentos(){
            return $this->documentos;
        }
        private function getTipoDocumentos(){
            return $this->tipoDocumentos;
        }


        public function setId($id){
            $this->id = $id;
        }
        public function setFecha($fecha){
            $this->fecha = $fecha;
        }	
        public function setHora($hora){
            $this->hora = $hora;
        }	
        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }

        public function setIdTipoDocumento($id){
            $this->idTipoDocumento = $id;
        }
        
        public function setDescripcionTipoDocumento($descripcion){
            $this->descripcionTipoDocumento = $descripcion;
        } 

        public function agregarTipoDocumento($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call agregarTipoDocumento($this->descripcionTipoDocumento, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function editarTipoDocumento($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call editarTipoDocumento($this->descripcionTipoDocumento, $this->id, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function desactivarTipoDocumento($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call desactivarTipoDocumento($this->id, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->desconectar();
        }
        
        public function verTipoDocumentos(){
            $this->conectar();

			$this->query = "SELECT 
                                idTipoDocumento as 'id', 
                                descripcionTipoDocumento as 'descripcion' 
                            FROM TIPODOCUMENTOS";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->tipoDocumentos = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'id' => $fila['id'],
					'descripcion' => $fila['descripcion']
				);

				array_push($this->tipoDocumentos, $arreglo);
			}
			$this->desconectar();
        }

        public function verTipoDocumentosActivos($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);


            $this->conectar();

			$this->query = "SELECT 
                                idTipoDocumento as 'id', 
                                descripcionTipoDocumento as 'descripcion' 
                            FROM TIPODOCUMENTOS
                            WHERE idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = '$estado->getDescripcion()')";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->tipoDocumentos = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'id' => $fila['id'],
					'descripcion' => $fila['descripcion']
				);

				array_push($this->tipoDocumentos, $arreglo);
			}
			$this->desconectar();
        }

        public function agregarDocumento($area, $areavia, $empleado, $prioridad, $estado){
            $this->areas = new Area();
            $areas->setNombre($area);
            
            $areasvia = new Area();
            $areasvia->setNombre($areavia);

            $this->empleados = new Empleado();
            $empleados->setCodigo($empleado);

            $this->prioridades = new Prioridad();
            $prioridades->setDescripcion($prioridad);

            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call agregarDocumento(
                                    '$this->id', 
                                    '$this->descripcionTipoDocumento', 
                                    '$this->fecha', 
                                    '$this->hora', 
                                    '$areas->getNombre()', 
                                    '$this->descripcion',  
                                    '$areasvia->getNombre()', 
                                    '$empleados->getCodigo()', 
                                    '$prioridades->getDescripcion()', 
                                    '$estados->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }
        
        public function editarDocumento($iddocumento, $area, $estado, $areavia, $empleado, $prioridad){

            $this->areas = new Area();
            $areas->setNombre($area);

            $areasvia = new Area();
            $areasvia->setNombre($areavia);

            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->empleados = new Empleado();
            $empleados->setCodigo($empleado);

            $this->prioridades = new Prioridad();
            $prioridades->setDescripcion($prioridad);

            $this->conectar();
            $this->query = "call editarDocumento(
                                    '$this->id', 
                                    '$iddocumento', 
                                    '$this->descripcionTipoDocumento', 
                                    '$this->fecha', 
                                    '$this->hora', 
                                    '$areas->getNombre()', 
                                    '$this->descripcion', 
                                    '$estados->getDescripcion()', 
                                    '$areasvia->getNombre()', 
                                    '$empleados->getCodigo()', 
                                    '$prioridades->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function desactivarDocumento($estado){
            
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call desactivarDocumento('$this->id', '$estados->getDescripcion()')";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function documentoEventoAgregar($descripcionEvento, $idEvento, $area, $estado, $areavia, $empleado, $estadoin,$prioridad){

            
            $this->eventos = new Evento();
            $eventos->setDescripcion($descripcionEvento);
            $eventos->setId($idEvento);

            $this->areas = new Area();
            $areas->setNombre($area);
            $areavias->setNombre($areavia);

            $this->estados = new Estado();
            $estados->setDescripcion($estado);
            $estadosin->setDescripcion($estadoin);

            $this->empleados = new Empleado();
            $empleados->setCodigo($empleado);

            $this->prioridades = new Prioridad();
            $prioridades->setDescripcion($prioridad);

            $this->conectar();
            $this->query = "call `documentoEventoAgregar`(
                                            '$this->id', 
                                            '$eventos->getId()', 
                                            '$eventos->setDescripcion()', 
                                            '$this->descripcionTipoDocumento', 
                                            '$this->fecha', 
                                            '$this->hora', 
                                            '$areas->getNombre()', 
                                            '$this->descripcion', 
                                            '$estados->getDescripcion()', 
                                            '$areavias->getNombre()', 
                                            '$empleados->getCodigo()', 
                                            '$prioridades->setDescripcion()', 
                                            '$estadosin->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function documentoEventoEditar($idanterior, $descripcionEvento, $idEvento, $area, $estado, $areavia, $empleado, $prioridad){

            $this->eventos = new Evento();
            $eventos->setDescripcion($descripcionEvento);
            $eventos->setId($idEvento);

            $this->areas = new Area();
            $areas->setNombre($area);
            $areavias->setNombre($areavia);

            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->empleados = new Empleado();
            $empleados->setCodigo($empleado);

            $this->prioridades = new Prioridad();
            $prioridades->setDescripcion($prioridad);

            $this->conectar();
            $this->query = "call `documentoEventoEditar`(   
                                        '$idanterior', 
                                        '$this->id', 
                                        '$eventos->getId()', 
                                        '$eventos->getDescripcion()', 
                                        '$this->descripcionTipoDocumento',
                                        '$this->fecha', 
                                        '$this->hora', 
                                        '$areas->getNombre()', 
                                        '$this->descripcion', 
                                        '$estados->getDescripcion()', 
                                        '$areavias->getNombre()', 
                                        '$empleados->getCodigo()', 
                                        '$prioridades->getDescripcion()') ;";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function verDocumentos(){

            $this->conectar();

			$this->query = "SELECT 
                                documento.idDocumento 'codigoDocumento',
                                documento.descripcionDocumento 'descripcion',
                                documento.fechaDocumento 'fecha',
                                documento.horaDocumento 'hora',
                                tipodocumento.descripcionTipoDocumento 'tipodocumento',
                                area.nombreArea 'AreaRecive',
                                area.idArea 'idAreaRecive',
                                facultad.nombreFacultad 'facultadRecive',
                                facultad.IdFacultad 'idfacultadRecive',
                                estado.descripcionEstado 'estado',
                                via.nombreArea 'areaVia',
                                via.idArea 'idareaVia',
                                facultadvia.nombreFacultad 'facultadVia',
                                facultadvia.idFacultad 'idfacultadVia',
                                empleado.codigoEmpleado 'codigoEmpleadoVia',
                                empleado.nombreEmpleado 'nombreEmpleadoVia',
                                empleado.apellidoEmpleado 'apellidoEmpleadoVia'
                            FROM DOCUMENTOS AS documento
                            inner join TIPODOCUMENTOS AS tipodocumento on documento.idTipoDocumento = tipodocumento.idTipoDocumento
                            inner join AREAS AS area on documento.idArea = area.idArea
                            inner join ESTADOS estado on documento.idEstado = estado.idEstado
                            inner join AREAS AS via on documento.areaVia = via.idArea
                            inner join EMPLEADOS AS empleado on documento.codigoEmpleado = empleado.codigoEmpleado
                            inner join FACULTADES AS facultad on area.idFacultad = facultad.idFacultad
                            inner join FACULTADES AS facultadvia on via.idFacultad = facultadvia.nombreFacultad
                            inner join PRIORIDADES AS prioridad on documento.idPrioridad = prioridad.idPrioridad;";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->documentos = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					
                    'codigoDocumento' => $fila['codigoDocumento'],
                    'descripcion' => $fila['descripcion'],
                    'fecha' => $fila['fecha'],
                    'hora' => $fila['hora'],
                    'tipodocumento' => $fila['tipodocumento'],
                    'AreaRecive' => $fila['AreaRecive'],
                    'idAreaRecive' => $fila['idAreaRecive'],
                    'facultadRecive' => $fila['facultadRecive'],
                    'idfacultadRecive' => $fila['idfacultadRecive'],
                    'estado' => $fila['estado'],
                    'areaVia' => $fila['areaVia'],
                    'idareaVia' => $fila['idareaVia'],
                    'facultadVia' => $fila['facultadVia'],
                    'idfacultadVia' => $fila['idfacultadVia'],
                    'codigoEmpleadoVia' => $fila['codigoEmpleadoVia'],
                    'nombreEmpleadoVia' => $fila['nombreEmpleadoVia'],
                    'apellidoEmpleadoVia' => $fila['apellidoEmpleadoVia']
				);

				array_push($this->estados, $arreglo);
			}
			$this->desconectar();
         
        }

        public function verDocumentosFiltro($estado, $area){

            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->areas = new Area();
            $areas->setNombre($area);
            
            $this->conectar();

			$this->query = "SELECT 
                                documento.idDocumento 'codigoDocumento',
                                documento.descripcionDocumento 'descripcion',
                                documento.fechaDocumento 'fecha',
                                documento.horaDocumento 'hora',
                                tipodocumento.descripcionTipoDocumento 'tipodocumento',
                                area.nombreArea 'AreaRecive',
                                area.idArea 'idAreaRecive',
                                facultad.nombreFacultad 'facultadRecive',
                                facultad.IdFacultad 'idfacultadRecive',
                                estado.descripcionEstado 'estado',
                                via.nombreArea 'areaVia',
                                via.idArea 'idareaVia',
                                facultadvia.nombreFacultad 'facultadVia',
                                facultadvia.idFacultad 'idfacultadVia',
                                empleado.codigoEmpleado 'codigoEmpleadoVia',
                                empleado.nombreEmpleado 'nombreEmpleadoVia',
                                empleado.apellidoEmpleado 'apellidoEmpleadoVia'
                            FROM DOCUMENTOS AS documento
                            inner join TIPODOCUMENTOS AS tipodocumento on documento.idTipoDocumento = tipodocumento.idTipoDocumento
                            inner join AREAS AS area on documento.idArea = area.idArea
                            inner join ESTADOS estado on documento.idEstado = estado.idEstado
                            inner join AREAS AS via on documento.areaVia = via.idArea
                            inner join EMPLEADOS AS empleado on documento.codigoEmpleado = empleado.codigoEmpleado
                            inner join FACULTADES AS facultad on area.idFacultad = facultad.idFacultad
                            inner join FACULTADES AS facultadvia on via.idFacultad = facultadvia.nombreFacultad
                            inner join PRIORIDADES AS prioridad on documento.idPrioridad = prioridad.idPrioridad
                            WHERE estado.descripcionEstado = '$estados->getDescripcion()' AND area.nombreArea = '$areas->getNombre()';";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->documentos = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					
                    'codigoDocumento' => $fila['codigoDocumento'],
                    'descripcion' => $fila['descripcion'],
                    'fecha' => $fila['fecha'],
                    'hora' => $fila['hora'],
                    'tipodocumento' => $fila['tipodocumento'],
                    'AreaRecive' => $fila['AreaRecive'],
                    'idAreaRecive' => $fila['idAreaRecive'],
                    'facultadRecive' => $fila['facultadRecive'],
                    'idfacultadRecive' => $fila['idfacultadRecive'],
                    'estado' => $fila['estado'],
                    'areaVia' => $fila['areaVia'],
                    'idareaVia' => $fila['idareaVia'],
                    'facultadVia' => $fila['facultadVia'],
                    'idfacultadVia' => $fila['idfacultadVia'],
                    'codigoEmpleadoVia' => $fila['codigoEmpleadoVia'],
                    'nombreEmpleadoVia' => $fila['nombreEmpleadoVia'],
                    'apellidoEmpleadoVia' => $fila['apellidoEmpleadoVia']
				);

				array_push($this->estados, $arreglo);
			}
			$this->desconectar();
         
        }
 
        
    }
?>