<?php
    require_once("conexion.php");
    require_once("estado.php");

    class Cargo extends Conexion{

        private $descripcion;
        private $id;

        private $estados;
        
        function __construct(){
			parent::__construct();

			$this->id = 0;
            $this->descripcion = 'vacio';
        }

        public function getDescripcion(){
            return $descripcion;
        }
        
        public function getId(){
            return $id;
        }

        public function setDescripcion($descripcion){
            $this->$descripcion = $descripcion;
        }
        
        public function setId($id){
            $this->id = $id;
        }

        public function agregarCargo($descripcion, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call agregarCargo($descripcion, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();

            $this->respuesta = 2;	
            $this->mensaje = "el cargo ha sido agregado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }
        public function editarCargo($descripcion, $id, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call editarCargo($descripcion, $id, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el cargo ha sido modificado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }
        public function desabilitarCargo($id, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call desactivarCargos($id, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el cargo ha sido modificado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;

        }
        public function verCargos(){
            $this->conectar();

			$this->query = "SELECT 
                                idCargo as 'id', 
                                descripcionCargo as 'descripcion' 
                            FROM CARGOS";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->estados = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'id' => $fila['id'],
					'descripcion' => $fila['descripcion']
				);

				array_push($this->estados, $arreglo);
			}

			$this->respuesta = 2;

			$this->desconectar();
        }
        public function verCargoActivos($estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);


            $this->conectar();

			$this->query = "SELECT 
                                idCargo as 'id', 
                                descripcionCargo as 'descripcion' 
                            FROM CARGOS
                            WHERE idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = $estado->getDescripcion())";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->estados = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'id' => $fila['id'],
					'descripcion' => $fila['descripcion']
				);

				array_push($this->estados, $arreglo);
			}

			$this->respuesta = 2;

			$this->desconectar();

        }
    }
?>