<?php
    require_once("conexion.php");
    require_once("estado.php");

    class Prioridad extends Conexion{
        
        private $id;
        private $descripcion;
        private $estados;
        
        function __construct(){
			parent::__construct();

			$this->id = 0;
            $this->descripcion = 'vacio';
        }

        public function getId(){
            return $this->id;
        }

        public function getDescripcion(){
            return $this->descripcion;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }

        public function agregarPrioridad($descripcion, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "CALL agregarPrioridad($descripcion, $estado->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el prioridad ha sido agregada";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }

        public function editarPrioridad($descripcion, $id, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "CALL editarPrioridad($descripcion, $id, $estado->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el prioridad ha sido editada";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }

        public function desactivarPrioridad($id, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "CALL desactivarPrioridad($id, $estado->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el prioridad ha sido editada";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }

        public function verPrioridades(){
            $this->conectar();

			$this->query = "SELECT 
                                idPrioridad as 'id', 
                                descripcionPrioridad as 'descripcion' 
                            FROM PRIORIDADES";

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

        public function verPrioridadActivas($estado){
            $this->estados = new Estados();
            
            $estados->setDescripcion($estado);

            $this->conectar();

			$this->query = "SELECT 
                                idSexo as 'id', 
                                descripcionSexo as 'descripcion' 
                            FROM SEXOS
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