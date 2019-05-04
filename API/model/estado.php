<?php
    require_once("conexion.php");

    class Estado extends Conexion{
        private $id; //entero
        private $descripcion; //text
        private $estado; //entero

        function __construct(){
			parent::__construct();

			$this->id = 0;
            $this->estado = 0;
            $this->descripcion = 'inactivo';
        }
        
        public function setEstado($estado){
			$this->estado = $estado;
        }
        
        public function setDesripcion($descripcion){
			$this->descripcion = $descripcion;
        }
        
        public function setId($id){
			$this->id = $id;
        }
        
        public function getEstado(){
			return $this->estado;
        }
        
        public function getDesripcion(){
			return $this->descripcion;
        }
        
        public function getId(){
			return $this->id;
		}

		public function agregarEstado(){
            $this->conectar();
            $this->query = "CALL agregarEstado($this->descripcion);";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el estado ha sido agregado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }

        public function editarEstado(){
            $this->conectar();
            $this->query = "CALL editarEstado($this->descripcion, $this->id, $this->estado);";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();

            $this->respuesta = 2;	
            $this->mensaje = "el estado ha sido actualizado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }

        public function desactivarEstado(){
			$this->conectar();
            $this->query = "CALL desactivarEstado($this->id, $this->estado);";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();

            $this->respuesta = 2;	
            $this->mensaje = "el estado ha sido actualizado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }
        
        public function verEstados(){
			$this->conectar();

			$this->query = "SELECT 
                                idEstado as 'id', 
                                descripcionEstado as 'descripcion' 
                            FROM ESTADOS";

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

        public function verEstadosActivos(){
			$this->conectar();

			$this->query = "SELECT 
                                idEstado as 'id', 
                                descripcionEstado as 'descripcion' 
                            FROM ESTADOS
                            WHERE estado = $this->estado";
                            
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