<?php
    require_once("conexion.php");
    require_once("estado.php");
     
    class Cargo extends Conexion{
        private $descripcion;
        private $id;

        private $cargos;

        //relacion
        private $estados;
        
        function __construct(){
			parent::__construct();
			$this->id = 0;
            $this->descripcion = '';
            $this->cargos = '';
        }

        public function getCargos(){
            return $this->cargos;
        }

        public function getDescripcion(){
            return $this->descripcion;
        }
        
        public function getId(){
            return $this->id;
        }
        public function setDescripcion($descripcion){
            $this->$descripcion = $descripcion;
        }
        
        public function setId($id){
            $this->id = $id;
        }

        public function agregarCargo($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);
            $this->conectar();
            $this->query = "call agregarCargo('$this->descripcion', '$estados->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function editarCargo($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);
            $this->conectar();
            $this->query = "call editarCargo('$this->descripcion', '$this->id', '$estados->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function desabilitarCargo($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);
            $this->conectar();
            $this->query = "call desactivarCargos('$this->id', '$estados->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function verCargos(){
            $this->conectar();
			$this->query = "SELECT 
                                idCargo as 'id', 
                                descripcionCargo as 'descripcion' 
                            FROM CARGOS";
			$resultSet = mysqli_query($this->conexion, $this->query);
            $this->cargos = array();
            
            while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'id' => $fila['id'],
					'descripcion' => $fila['descripcion']
				);
				array_push($this->cargos, $arreglo);
            }  
			$this->desconectar();
        }
       
        public function verCargoActivos($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);
            
            $this->conectar();
			$this->query = "SELECT 
                                idCargo as 'id', 
                                descripcionCargo as 'descripcion' 
                            FROM CARGOS
                            WHERE idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = '$estado->getDescripcion()')";
			$resultSet = mysqli_query($this->conexion, $this->query);
           
            $this->cargos = array();
            
            while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'id' => $fila['id'],
					'descripcion' => $fila['descripcion']
				);
				array_push($this->cargos, $arreglo);
			}
			$this->desconectar();
        }
    }
?>