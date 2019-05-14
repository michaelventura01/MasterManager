<?php
    include_once("conexion.php");
    include_once("estado.php");
    include_once("empleado.php");
    include_once("area.php");
    include_once("documento.php");

    class Evento extends Conexion{
        
        private $descripcion;
        private $fechaInicio;
        private $horaInicio;
        private $id;
        private $fechaFinal;
        private $horaFinal;
        private $idTiempo;
        private $tiempoTotal;
        private $eventos;

        //relacion
        private $estados;
        private $documentos;
        private $areas;
        private $empleados;

        function __construct(){
			parent::__construct();

			$this->descripcion = '';
            $this->fechaInicio = '';
            $this->horaInicio = 0;
            $this->id = 0;
            $this->fechaFinal = '';
            $this->horaFinal = '';
            $this->idTiempo = 0;
            $this->tiempoTotal = 0;
            $this->eventos = '';
        }

        public function getDescripcion(){
            return $this->descripcion;
        }
        public function getFechaInicio(){
            return $this->fechaInicio;
        }
        public function getHoraInicio(){
            return $this->horaInicio;
        }
        public function getId(){
            return $this->id;
        }
        public function getFechaFinal(){
            return $this->fechaFinal;
        }
        public function getHoraFinal(){
            return $this->horaFinal;
        }
        public function getIdTiempo(){
            return $this->idTiempo;
        }
        public function getTiempoTotal(){
            return $this->tiempoTotal;
        }

        public function getEventos(){
            return $this->eventos;
        }

        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }
        public function setFechaInicio($fecha){
            $this->fechaInicio = $fecha;
        }
        public function setHoraInicio($hora){
            $this->horaInicio = $hora;
        }
        public function setId($id){
            $this->id = $id;
        }
        public function setFechaFinal($fecha){
            $this->fechaFinal = $fecha;
        }
        public function setHoraFinal($hora){
            $this->horaFinal = $hora;
        }
        public function setIdTiempo($id){
            $this->idTiempo = $id;
        }
        public function setTiempoTotal($tiempo){
            $this->tiempoTotal = $tiempo;
        }
 
        public function VerEventosActivos($estado, $documento){
            
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->documentos = new Documento();
            $documentos->setId($documento);
            $this->conectar();

			$this->query = "SELECT 
                                evento.idEvento 'idevento',
                                evento.horaEvento 'horaevento',
                                evento.fechaEvento 'fechaevento',
                                evento.descripcionEvento 'decripcionevento',
                                documento.idDocumento 'codigodocumento',
                                documento.descripcionDocumento 'documento',
                                documento.fechaDocumento 'fechadocumento',
                                documento.horaDocumento 'horadocumento',
                                estadodocumento.descripcionEstado 'estadodocumento',
                                estadoevento.descripcionEstado 'estadoevento',
                                area.nombreArea 'areaevento',
                                area.idArea 'idArea'
                            FROM EVENTOS AS evento
                            inner join DOCUMENTOS AS documento on evento.iddocumento = documento.iddocumento
                            inner join ESTADOS AS estadoevento on evento.idestado = estadoevento.idEstado
                            inner join AREAS AS area on evento.idarea = area.idArea
                            inner join ESTADOS AS estadodocumento on documento.idEstado = estadodocumento.idEstado
                            WHERE estado.descripcionEstado = '$estados->getDescripcion()' AND documento.iddocumento = '$documentos->getId()';";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->estados = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					
                    'idevento' => $fila['idevento'],
                    'horaevento' => $fila['horaevento'],
                    'fechaevento' => $fila['fechaevento'],
                    'decripcionevento' => $fila['decripcionevento'],
                    'codigodocumento' => $fila['codigodocumento'],
                    'documento' => $fila['documento'],
                    'fechadocumento' => $fila['fechadocumento'],
                    'horadocumento' => $fila['horadocumento'],
                    'estadodocumento' => $fila['estadodocumento'],
                    'estadoevento' => $fila['estadoevento'],
                    'areaevento' => $fila['areaevento'],
                    'idArea' => $fila['idArea']
				);

				array_push($this->estados, $arreglo);
			}
			$this->desconectar();
        }
    }

?>
