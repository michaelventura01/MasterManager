<?php
    require_once("conexion.php");
    require_once("estado.php");
   
    class Rol extends Conexion{

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

        public function agregarRol($descripcion, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call agregarRoles($descripcion, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();

            $this->respuesta = 2;	
            $this->mensaje = "el rol ha sido agregado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }

        public function editarRol($id, $descripcion, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call editarRoles($descripcion, $id, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el genero ha sido modificado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }

        public function desactivarRol($id, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call desactivarRoles($id, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el rol ha sido modificado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }
        
        public function verRoles(){
            $this->conectar();

			$this->query = "SELECT 
                                idRol as 'id', 
                                descripcionRol as 'descripcion' 
                            FROM ROLES";

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

        public function verRolesActivos($estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);


            $this->conectar();

			$this->query = "SELECT 
                                idRol as 'id', 
                                descripcionRol as 'descripcion' 
                            FROM ROLES
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