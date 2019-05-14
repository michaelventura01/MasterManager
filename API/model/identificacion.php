<?php
    require_once("conexion.php");
    require_once("estado.php");
   
    class Identificacion extends Conexion{

        private $id; 
        private $descripcion; 

        private $identificaciones;
        

        //relacion
        private $estados; 

        function __construct(){
			parent::__construct();

			$this->id = 0;
            $this->descripcion = '';

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

        public function getIdentificaciones(){
            return $this->identificaciones;
        }

        public function agregarIdentificacion($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call agregarIdentificacion('$this->descripcion', '$estados->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function editarIdentificacion($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call editarIdentificacion('$this->descripcion', '$this->id', '$estados->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function desactivarIdentificacion($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call desactivarIdentificacion('$this->id', '$estados->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }
        
        public function verIdentificaciones(){
            $this->conectar();

			$this->query = "SELECT 
                                idIdentificacion as 'id', 
                                descripcionIdentificacion as 'descripcion' 
                            FROM IDENTIFICACIONES";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->prioridades = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'id' => $fila['id'],
					'descripcion' => $fila['descripcion']
				);

				array_push($this->prioridades, $arreglo);
			}
			$this->desconectar();
        }

        public function verIdentificacionActivos($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);


            $this->conectar();

			$this->query = "SELECT 
                                idIdentificacion as 'id', 
                                descripcionIdentificacion as 'descripcion' 
                            FROM IDENTIFICACIONES
                            WHERE idEstado = (SELECT idEstado FROM ESTADOS WHERE descripcionEstado = '$estado->getDescripcion()')";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->prioridades = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'id' => $fila['id'],
					'descripcion' => $fila['descripcion']
				);
				array_push($this->prioridades, $arreglo);
            }
            
            $this->desconectar();
        }
    }

?>