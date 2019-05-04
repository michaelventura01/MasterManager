<?php
	class Conexion{
		private $host;
		private $userName;
		private $password;
		private $dataBase;
		public $conexion;
		public $query;
        public $respuesta;
        public $mensaje;
        public $answer;

		public function __construct(){
			$this->host = 'localhost';
			$this->userName = 'id8696707_root';
			$this->password = '123456';
			$this->dataBase = 'id8696707_registrosdocumentosdb';
			$this->conexion = null;
			$this->query = "";
			$this->respuesta = 0;
		}

		public function prueba(){
			//echo "host: " .$this->host;
		}

		public function getHost(){
			return $this->host;
		}

		public function conectar(){
			$this->conexion = new mysqli($this->host, $this->userName, $this->password, $this->dataBase);
			if ($this->conexion->connect_errno){
                $respuesta = 1;	
                $mensaje = "Ha ocurrido problemas con el servidor";			
			}
		}

		public function desconectar(){
			mysqli_close($this->conexion);
		}
	}
?>