<?php
    require_once("conexion.php");
    require_once("estado.php");
    require_once("rol.php");
   
    class Enlace extends Conexion{
       
        private $id;
        private $nombre;
        private $url;

        private $enlaces;
        
        //relacion
        private $estados;
        private $roles; 
        
        function __construct(){
			parent::__construct();
			$this->id = 0;
            $this->nombre = '';
            $this->url = '';
            $this->enlaces = '';
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

        public function getEnlaces(){
            return $this->enlaces;
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
 
        public function agregarEnlace($estado, $rol){
            
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->roles = new Rol();
            $roles->setDescripcion($rol);

            $this->conectar();
            $this->query = "enlacerolagregar`('$this->nombre', '$this->url', '$estados->getDescripcion()', '$roles->setDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
        }
        
        public function editarEnlace($idenlacerol,$estado, $rol){
            
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->roles = new Rol();
            $roles->setDescripcion($rol);

            $this->conectar();
            $this->query = "call `enlaceroleditar`('$this->id', '$idenlacerol', '$this->nombre', '$this->url', '$estados->getDescripcion()', '$roles->getDescripcion()'); ";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function desactivarEnlace($estado){
            
            $this->estados = new Estado();
            $estados->setDescripcion($estado);
            $this->conectar();
            $this->query = "call desactivarEnlace('$this->id', '$estados->getDescripcion()');";
			$this->conexion->query($this->query);
			$this->desconectar();
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
            
            $this->enlaces = array();
            
            while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
                    'id' => $fila['id'],
                    'enrol' => $fila['enrol'],
                    'nombre' => $fila['nombre'],
                    'url' => $fila['url'],
                    'rol' => $fila['rol'],
                    'estado' => $fila['estado']
				);
				array_push($this->enlaces, $arreglo);
			}
        }

        public function verEnlaceActivos($estado){
            
            $this->estados = new Estado();
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
                            WHERE enlace.idEstado = (SELECT idEstado from ESTADOS where descripcionEstado = '$estados->setDescripcion()');";
			$resultSet = mysqli_query($this->conexion, $this->query);
            
            $this->enlaces = array();
            
            while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
                    'id' => $fila['id'],
                    'enrol' => $fila['enrol'],
                    'nombre' => $fila['nombre'],
                    'url' => $fila['url'],
                    'rol' => $fila['rol'],
                    'estado' => $fila['estado']
				);
				array_push($this->enlaces, $arreglo);
			}
        }
    }
?>