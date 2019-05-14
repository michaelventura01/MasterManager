<?php
    require_once("conexion.php");
    require_once("estado.php");
    require_once("empleado.php");
    require_once("area.php");
    require_once("cargo.php");
   
    class Facultad extends Conexion{
        private $id; 
        private $nombre;
        private $correo;
        private $direccion;
        private $telefono;
        private $enlaceFoto;
        private $idFoto;
        private $fechaInicio;
        private $fechaFin;

        private $facultades;
        
        //relacion
        private $estados;
        private $empleados;
        private $areas;
        private $cargos;
        
        function __construct(){
			parent::__construct();
			$this->id = 0;
            $this->nombre = '';
            $this->correo = '';
            $this->direccion = '';
            $this->telefono = '';
            $this->enlaceFoto = '';
            $this->facultades = '';
            $this->idFoto = 0;
            $this->fechaInicio = '';
            $this->fechaFin = '';
        }

        private function setEnlaceFoto($enlace){
            $this->enlaceFoto = $enlace;
        }
        private function  setIdFoto($id){
            $this->idFoto = $id;
        }
        public function setId($id){
            $this->id = $id;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function setCorreo($correo){
            $this->correo = $correo;
        }
        public function setDireccion($direccion){
            $this->direccion = $direccion;
        }
        public function setTelefono($telefono){
            $this->telefono = $telefono;
        }

        public function  setFechaInicio($fecha){
            $this->fechaInicio = $fecha;
        }
        public function  setFechaFin($fecha){
            $this->fechaFin = $fecha;
        }

        public function getFacultades(){
            $this->facultades;
        }

        public function getId(){
            return $this->id;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getCorreo(){
            return $this->correo;
        }
        public function getDireccion(){
            return $this->direccion;
        }
        public function getTelefono(){
            return $this->telefono;
        }
        private function getEnlaceFoto(){
            return $this->enlaceFoto;
        }
        private function getIdFoto(){
            return $this->idFoto;
        }

        public function  getFechaInicio(){
            return $this->fechaInicio;
        }
        public function  getFechaFin(){
            return $this->fechaFin;
        }


        public function agregarConfiguracionFacultad($empleado, $area, $cargo, $idareaempleado, $estado){
            
            $this->empleados = new Empleado();
            $empleados->setCodigo($empleado);

            $this->areas = new Area();
            $areas->setNombre($area);

            $this->areaempleados = new Area();
            $areaempleados->setId($idareaempleado);

            $this->cargos = new Cargo();
            $cargos->setDescripcion($cargo);

            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call agregarConfiguracionFacultad(
                                                    '$this->nombre', 
                                                    '$this->id', 
                                                    '$this->correo', 
                                                    '$this->direccion', 
                                                    '$this->telefono', 
                                                    '$this->enlacefoto', 
                                                    '$empleados->getCodigo()',
                                                    '$areas->getNombre()', 
                                                    '$cargos->getDescripcion()', 
                                                    '$areaempleados->getId()', 
                                                    '$estados->getDescripcion()', 
                                                    '$this->fechaInicio'
                                                );";
			$this->conexion->query($this->query);
			$this->desconectar();
    
        
        }
        public function editarConfiguracionFacultad($idfacultad, $empleado, $area, $cargo, $idareaempleado, $estado){
            
            $this->empleados = new Empleado();
            $empleados->setCodigo($empleado);

            $this->areas = new Area();
            $areas->setNombre($area);

            $this->areaempleados = new Area();
            $areaempleados->setId($idareaempleado);

            $this->cargos = new Cargo();
            $cargos->setDescripcion($cargo);

            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call configuracionFacultadEditar(
                                                    '$this->nombre', 
                                                    '$this->id',
                                                    '$idfacultad', 
                                                    '$this->correo', 
                                                    '$this->direccion', 
                                                    '$this->telefono', 
                                                    '$this->enlacefoto', 
                                                    '$empleados->getCodigo()',
                                                    '$areas->getNombre()', 
                                                    '$cargos->getDescripcion()', 
                                                    '$areaempleados->getId()', 
                                                    '$estados->getDescripcion()', 
                                                    '$this->fechaInicio'
                                                );";
			$this->conexion->query($this->query);
			$this->desconectar();
   
        }
        public function desactivarConfiguracionFacultad($estado, $idareaempleado){
            
            $this->areaempleados = new Area();
            $areaempleados->setId($idareaempleado);

            $this->estados = new Estado();
            $estados->setDescripcion($estado);

           $this->conectar();
           $this->query = "call desactivarConfiguracionFacultad(
                                                    '$this->id',  
                                                    '$areaempleados->getId()', 
                                                    '$estados->getDescripcion()'
                                                );";
           $this->conexion->query($this->query);
           $this->desconectar();
        
        
        }
        
        public function verFacultades(){
            
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
			$this->query = "SELECT 
                                `idFacultad` 'id',
                                `nombreFacultad` 'nombre',
                                `direccionFacultad` 'direccion',
                                `telefonoFacultad` 'telefono',
                                `correoFacultad` 'correo' 
                            FROM `FACULTADES`;";

                            
			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->facultades = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'id' => $fila['id'],
                    'nombre' => $fila['nombre'],
                    'direccion' => $fila['direccion'],
                    'telefono' => $fila['telefono'],
                    'correo' => $fila['correo']
				);

				array_push($this->sexos, $arreglo);
			}
			$this->desconectar();
        }
        public function verFacultadesActivas($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
			$this->query = "SELECT 
                                `idFacultad` 'id',
                                `nombreFacultad` 'nombre',
                                `direccionFacultad` 'direccion',
                                `telefonoFacultad` 'telefono',
                                `correoFacultad` 'correo' 
                            FROM `FACULTADES`
                            WHERE idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = '$estado->getDescripcion()')";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->facultades = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'id' => $fila['id'],
                    'nombre' => $fila['nombre'],
                    'direccion' => $fila['direccion'],
                    'telefono' => $fila['telefono'],
                    'correo' => $fila['correo']
				);

				array_push($this->sexos, $arreglo);
			}
			$this->desconectar();
        }
    }

    /*
    

    */
?>