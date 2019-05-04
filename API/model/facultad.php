<?php
    require_once("conexion.php");
    require_once("estado.php");
   
    class Facultad extends Conexion{

        private $id; 
        private $nombre;
        private $correo;
        private $direccion;
        private $telefono;
      
        private $estados; //relacion

        function __construct(){
			parent::__construct();

			$this->id = 0;
            $this->nombre = 'vacio';
            $this->correo = 'vacio';
            $this->direccion = 'vacio';
            $this->telefono = 'vacio';
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

        public function agregarFacultad($descripcion, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            //$this->query = "call agregarRoles($descripcion, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();

            $this->respuesta = 2;	
            $this->mensaje = "el rol ha sido agregado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }

        public function editarFacultad($id, $descripcion, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            //$this->query = "call editarRoles($descripcion, $id, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el genero ha sido modificado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }

        public function desactivarFacultad($id, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            //$this->query = "call desactivarRoles($id, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el rol ha sido modificado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }
        
        public function verFacultades(){
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

        public function verFacultadesActivos($estado){
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