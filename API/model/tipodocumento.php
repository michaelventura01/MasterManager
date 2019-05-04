<?php
    require_once("conexion.php");
    require_once("estado.php");

    class TipoDocumentos extends Conexion{

        private $id;
        private $descripcion;

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

        public function agregarTipoDocumento($descripcion, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call agregarTipoDocumento($descripcion, $this->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el tipo de documento ha sido agregado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }

        public function editarTipoDocumento($id, $descripcion, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call editarTipoDocumento($descripcion, $id, $this->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el tipo de documento ha sido modificado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }

        public function desactivarTipoDocumento($id, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call desactivarTipoDocumento($id, $this->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el tipo de documento ha sido modificado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }
        
        public function verTipoDocumentos(){
            $this->conectar();

			$this->query = "SELECT 
                                idTipoDocumento as 'id', 
                                descripcionTipoDocumento as 'descripcion' 
                            FROM TIPODOCUMENTOS";

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

        public function verTipoDocumentosActivos($estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);


            $this->conectar();

			$this->query = "SELECT 
                                idTipoDocumento as 'id', 
                                descripcionTipoDocumento as 'descripcion' 
                            FROM TIPODOCUMENTOS
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