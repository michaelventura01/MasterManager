<?php
    require_once("conexion.php");
    require_once("estado.php");
    
    class Sexo extends Conexion{
        
        private $id; 
        private $descripcion;

        private $sexos;

        //relacion
        private $estados;
        
        function __construct(){
			parent::__construct();

			$this->id = 0;
            $this->descripcion = '';
            $this->sexos ='';
        }

        public function getSexos(){
            return $this->sexos;
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
            $this->id = $descripcion;
        } 
 
        
        public function agregarSexo($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call agregarSexo('$this->descripcion', '$estados->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function editarSexo($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call editarSexo('$this->id', '$this->descripcion', '$estados->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function desactivarSexo($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call desactivarSexo('$this->id', '$estados->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }
        
        public function verSexos(){
            $this->conectar();

			$this->query = "SELECT 
                                idSexo as 'id', 
                                descripcionSexo as 'descripcion' 
                            FROM SEXOS";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->sexos = array();
            
            while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'id' => $fila['id'],
					'descripcion' => $fila['descripcion']
				);

				array_push($this->sexos, $arreglo);
			}
			$this->desconectar();
        }

        public function verSexosActivos($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
			$this->query = "SELECT 
                                idSexo as 'id', 
                                descripcionSexo as 'descripcion' 
                            FROM SEXOS
                            WHERE idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = '$estados->getDescripcion()')";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->sexos = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'id' => $fila['id'],
					'descripcion' => $fila['descripcion']
				);

				array_push($this->sexos, $arreglo);
			}
			$this->desconectar();
        }
    }
    
?>