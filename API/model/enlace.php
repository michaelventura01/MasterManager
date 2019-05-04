<?php
    require_once("conexion.php");
    require_once("estado.php");
    require_once("rol.php");
   
    class Enlace extends Conexion{


       

        private $id;
        private $nombre;
        private $url;
      
        private $estados;
        private $roles; //relacion

        function __construct(){
			parent::__construct();

			$this->id = 0;
            $this->nombre = 'vacio';
            $this->url = 'vacio';
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        public function setUrl($url){
            $this->url = $url;
        }

        public function getId(){
            return $this->id;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getUrl(){
            return $this->url;
        }
 
        public function agregarEnlace($nombre, $enlace, $estado, $rol, $idenlacerol){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call agregarEnlace($nombre, $enlace, $estados->getDescripcion());
                            call agregarEnlacesRoles((SELECT idEnlace FROM ENLACES WHERE nombreEnlace = $nombre AND urlEnlace = $enlace), $rol);";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();

            $this->respuesta = 2;	
            $this->mensaje = "el enlace ha sido agregado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }

        public function editarEnlace($id, $nombre, $enlace, $estado, $rol){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call editarEnlace($id, $nombre, $enlace, $estados->getDescripcion());
                            call editarEnlacesRoles($idenlacerol, $id, $rol);";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el enlace ha sido modificado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }

        //CREATE PROCEDURE desactivarEnlace(IN id text, in estado text)


        public function desactivarEnlace($id, $estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);

            $this->conectar();
            $this->query = "call desactivarEnlace($id, $estados->getDescripcion());";
			$this->conexion->query($this->query);
			$this->idCliente = mysqli_insert_id($this->conexion);
            $this->desconectar();
            
            $this->respuesta = 2;	
            $this->mensaje = "el enlace ha sido modificado";
            $this->answer = array($respuesta, $mensaje);
            return $this->answer;
        }
        
        public function verEnlaces(){
            $this->conectar();

			$this->query = "SELECT  enlace.idenlace as 'id', 
                                    enrol.idEnlaceRol as 'idenrol', 
                                    enlace.nombreEnlace as 'nombre',
                                    enlace.urlEnlace as 'url',
                                    rol.descripcionRol 'rol',
                                    estado.descripcionEstado 'estado'
                            FROM ENLACES enlace
                            INNER JOIN ENLACESROLES enrol on enlace.idenlace = enrol.idEnlace
                            inner join ROLES rol on enrol.idRol = rol.idRol
                            inner join ESTADOS estado on enlace.idEstado = estado.idEstado
                            ";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->estados = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
                    'id' => $fila['id'],
                    'enrol' => $fila['enrol'],
                    'nombre' => $fila['nombre'],
                    'url' => $fila['url'],
                    'rol' => $fila['rol'],
                    'estado' => $fila['estado']
				);

				array_push($this->estados, $arreglo);
			}

			$this->respuesta = 2;

			$this->desconectar();
        }

        public function verEnlaceActivos($estado){
            $this->estados = new Estados();
            $estados->setDescripcion($estado);
            
            $this->conectar();

			$this->query = "SELECT  enlace.idenlace as 'id',
                                    enrol.idEnlaceRol as 'idenrol', 
                                    enlace.nombreEnlace as 'nombre',
                                    enlace.urlEnlace as 'url',
                                    rol.descripcionRol 'rol',
                                    estado.descripcionEstado 'estado'
                            FROM ENLACES enlace
                            INNER JOIN ENLACESROLES enrol on enlace.idenlace = enrol.idEnlace
                            inner join ROLES rol on enrol.idRol = rol.idRol
                            inner join ESTADOS estado on enlace.idEstado = estado.idEstado
                            WHERE enlace.idEstado = (SELECT idEstado from ESTADOS where descripcionEstado = $estado);";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->estados = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
                    'id' => $fila['id'],
                    'enrol' => $fila['enrol'],
                    'nombre' => $fila['nombre'],
                    'url' => $fila['url'],
                    'rol' => $fila['rol'],
                    'estado' => $fila['estado']
				);

				array_push($this->estados, $arreglo);
			}

			$this->respuesta = 2;

			$this->desconectar();
        }
    }
?>