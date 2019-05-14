<?php
    require_once("conexion.php");
    require_once("estado.php");
   
    class Rol extends Conexion{

        private $id;
        private $descripcion;
        
        private $roles;

        //relacion
        private $estados; 

        function __construct(){
			parent::__construct();

			$this->id = 0;
            $this->descripcion = '';
            $this->roles = '';
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

        public function getRoles(){
            return $this->roles;
        }

        public function agregarRol($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call agregarRoles('$this->descripcion', '$estados->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function editarRol($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call editarRoles('$this->descripcion', '$this->id', '$estados->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function desactivarRol($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call desactivarRoles('$this->id', '$estados->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }
        
        public function verRoles(){
            $this->conectar();

			$this->query = "SELECT 
                                idRol as 'id', 
                                descripcionRol as 'descripcion' 
                            FROM ROLES";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->roles = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'id' => $fila['id'],
					'descripcion' => $fila['descripcion']
				);

				array_push($this->roles, $arreglo);
			}
            $this->desconectar();
        }

        public function verRolesActivos($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);


            $this->conectar();

			$this->query = "SELECT 
                                idRol as 'id', 
                                descripcionRol as 'descripcion' 
                            FROM ROLES
                            WHERE idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = '$estado->getDescripcion()')";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->roles = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'id' => $fila['id'],
					'descripcion' => $fila['descripcion']
				);

				array_push($this->roles, $arreglo);
			}
			$this->desconectar();
        }
    }
?>