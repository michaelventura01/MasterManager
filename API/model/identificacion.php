<?php
    require_once("conexion.php");
    require_once("estado.php");
   
    class Identificacion extends Conexion{

        private $id; //entero
        private $descripcion; //text
        
        private $estados; //relacion

        function __construct(){
			parent::__construct();

			$this->id = 0;
            $this->descripcion = 'vacio';
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }

        public function getId(){
            return $this->id;
        }

        public function getDescripcion(){
            return $this->descripcion;
        }

        public function agregarIdentificacion($descripcion, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call agregarIdentificacion($descripcion, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();

            $this->respuesta = 2;	
            $this->mensaje = "la identificacion ha sido agregada";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }

        public function editarIdentificacion($id, $descripcion, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call editarIdentificacion($descripcion, $id, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "la identificacion ha sido modificada";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }

        public function desactivarIdentificacion($id, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call desactivarIdentificacion($id, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "la identificacion ha sido modificada";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }
        
        public function verIdentificaciones(){
            $this->conectar();

			$this->query = "SELECT 
                                idIdentificacion as 'id', 
                                descripcionIdentificacion as 'descripcion' 
                            FROM IDENTIFICACIONES";

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

        public function verIdentificacionActivos($estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);


            $this->conectar();

			$this->query = "SELECT 
                                idIdentificacion as 'id', 
                                descripcionIdentificacion as 'descripcion' 
                            FROM IDENTIFICACIONES
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