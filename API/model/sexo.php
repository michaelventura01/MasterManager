<?php
    require_once("conexion.php");
    require_once("estado.php");
    
    class Sexos extends Conexion{
        
        private $id;
        private $descripcion;

        private $estados;
        
        function __construct(){
			parent::__construct();

			$this->id = 0;
            $this->descripcion = 'vacio';
        }

        public function getId(){
            return $id;
        }
        
        public function getDescripcion(){
            return $descripcion;
        }

        public function setId($id){
            $this->id = $id;
        }
        
        public function setDescripcion($descripcion){
            $this->id = $descripcion;
        } 
 
        
        public function agregarSexo($descripcion, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call agregarSexo($descripcion, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el genero ha sido agregado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }

        public function editarSexo($id, $descripcion, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call editarSexo($id, $descripcion, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el genero ha sido modificado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }

        public function desactivarSexo($id, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call desactivarSexo($id, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el genero ha sido modificado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }
        
        public function verSexos(){
            $this->conectar();

			$this->query = "SELECT 
                                idSexo as 'id', 
                                descripcionSexo as 'descripcion' 
                            FROM SEXOS";

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

        public function verSexosActivos($estado){
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