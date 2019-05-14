<?php
    require_once("conexion.php");
    require_once("estado.php");
 
    class Prioridad extends Conexion{
        
        private $id;
        private $descripcion;
        private $prioridades;
        
        //relacion
        private $estados;
        
        function __construct(){
			parent::__construct();

			$this->id = 0;
            $this->descripcion = '';
            $this->prioridades = '';
        }

        public function getPrioridades(){
            return $this->prioridades;
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

        public function agregarPrioridad($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "CALL agregarPrioridad('$this->descripcion', '$estado->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function editarPrioridad($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "CALL editarPrioridad('$this->descripcion', '$this->id', '$estado->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function desactivarPrioridad($estado){
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "CALL desactivarPrioridad('$this->id', '$estado->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function verPrioridades(){
            $this->conectar();
			$this->query = "SELECT 
                                idPrioridad as 'id', 
                                descripcionPrioridad as 'descripcion' 
                            FROM PRIORIDADES";

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

        public function verPrioridadActivas($estado){
            $this->estados = new Estado();            
            $estados->setDescripcion($estado);

            $this->conectar();
			$this->query = "SELECT 
                                idPrioridad as 'id', 
                                descripcionPrioridad as 'descripcion' 
                            FROM PRIORIDADES
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