<?php
    include_once("conexion.php");
    include_once("estado.php");
    include_once("identificacion.php");
    include_once("sexo.php");
    include_once("area.php");
    include_once("cargo.php");
    include_once("usuario.php");
    include_once("rol.php");
    include_once("facultad.php");

    class Empleado extends Conexion{
        private $apellido;
        private $codigo;
        private $correo;
        private $identificacion;
        private $nombre;
        private $telefono;
        private $idfoto;
        private $enlaceFoto;
        private $fechaInicio;
        private $fechaNacimiento;

        private $empleados;


        //relacion
        private $identificaciones;
        private $estados;
        private $sexos;
        private $areas;
        private $cargos;
        private $usuarios;
        private $roles;
        private $facultades;

        function __construct(){
			parent::__construct();

            $this->apellido = '';
            $this->codigo = '';
            $this->correo = '';
            $this->identificacion = '';
            $this->nombre = '';
            $this->telefono = '';
            $this->idfoto = '';
            $this->enlaceFoto = '';
            $this->empleados = '';
        }

        public function getEmpleados(){
            return $this->empleados;
        }

        public function getApellido(){
            return $this->apellido;
        }
        public function getCodigo(){
            return $this->codigo;
        }
        public function getCorreo(){
            return $this->correo;
        }
        public function getIdentificacion(){
            return $this->identificacion;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function getTelefono(){
            return $this->telefono;
        }

        public  function getIdFoto(){
            return $this->idFoto;
        }
        public  function getEnlaceFoto(){
            return $this->enlaceFoto;
        }

        public function getFechaInicio(){
            return $this->fechaInicio;
        }

        public function getFechaNacimiento(){
            return $this->fechaNacimiento;
        }


        public function setApellido($apellido){
            $this->apellido = $apellido;    
        }
        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }
        public function setCorreo($correo){
            $this->correo = $correo;
        }
        public function setIdentificacion($identificacion){
            $this->identificacion = $identificacion;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function setTelefono($telefono){
            $this->telefono = $telefono;
        }    

        public function setIdFoto($id){
            $this->idFoto = $id;
        }
        public function setEnlaceFoto($enlace){
            $this->enlaceFoto = $enlace;
        }

        public function setFechaInicio($fecha){
            $this->fechaInicio = $fecha;
        }

        public function setFechaNacimiento($fecha){
            $this->fechaNacimiento = $fecha;
        }

        public function agregarEmpleadoUsuario($tipoidentificacion,$estado, $usuario, $clave, $rol, $area, $cargo, $sexo){
            
            $this->identificaciones = new Identificacion();
            $identificaciones->setDescripcion($tipoidentificacion);
            
            $this->estados = new Estado();
            $estados->setDescripcion($estado);

            $this->usuarios = new Usuario();
            $usuarios->setUsuario($usuario);
            $usuarios->setClave($clave);

            $this->roles = new Rol();
            $roles->setDescripcion($rol);

            $this->areas = new Area();
            $areas->setNombre($area);

            $this->cargos = new Cargo();
            $cargos->setDescripcion($cargo);

            $this->sexos = new Sexo();
            $sexos->setDescripcion($sexo);


            $this->conectar();
            $this->query = "call empleadoUsuarioAgregar(
                                '$this->codigo', 
                                '$this->identificacion', 
                                '$identificaciones->getDescripcion()', 
                                '$this->nombre', 
                                '$this->apellido',  
                                '$this->telefono', 
                                '$this->correo', 
                                '$usuarios->getUsuario()', 
                                '$usuarios->getClave()', 
                                '$roles->getDescripcion()', 
                                '$areas->getNombre()', 
                                '$cargos->getDescripcion()', 
                                '$sexos->getDescripcion()', 
                                '$this->enlaceFoto', 
                                '$estados->getDescripcion()', 
                                '$this->fechaNacimiento', 
                                '$this->fechaInicio'
                            );";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function editarEmpleadoUsuario($tipoidentificacion, $usuario, $clave, $rol, $area, $idArea, $sexo, $areaempleadoid,$idusuario, $estado,$estadoinverso, $cargo){
            
            $this->identificaciones = new Identificacion();
            $identificaciones->setDescripcion($tipoidentificacion);

            $this->usuarios = new Usuario();
            $usuarios->setUsuario($usuario);
            $usuarios->setClave($clave);
            $usuarios->setId($idusuario);

            $this->roles = new Rol();
            $roles->setDescripcion($rol);

            $this->areas = new Area();
            $areas->setNombre($area);
            $areas->setId($idArea);
            $areaempleados->setId($areaempleadoid);

            $this->sexos = new Sexo();
            $sexos->setDescripcion($sexo);

            $this->estados = new Estado();
            $estados->setDescripcion($estado);
            $estadoin->setDescripcion($estadoinverso);

            $this->cargos = new Cargo();
            $cargos->setDescripcion($cargo);

            $this->conectar();
            $this->query = "call empleadoUsuarioEditar(
                                '$this->codigo', 
                                '$this->identificacion',
                                '$identificaciones->getDescripcion()', 
                                '$this->nombre', 
                                '$this->apellido',  
                                '$this->telefono', 
                                '$this->correo', 
                                '$usuarios->getUsuario()', 
                                '$usuarios->getClave()', 
                                '$roles->getDescripcion()', 
                                '$areas->getNombre()', 
                                '$cargos->getDescripcion()', 
                                '$sexos->getDescripcion()', 
                                '$this->enlaceFoto', 
                                '$estados->getDescripcion()',
                                '$this->codigo', 
                                '$this->idFoto', 
                                '$areas->getId()', 
                                '$areaempleados->getId()', 
                                '$usuarios->getId()', 
                                '$this->fechaNacimiento', 
                                '$this->fechaInicio', 
                                '$estadoin->setDescripcion()')";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function desactivarEmpleadoUsuario($idusuario,$estado, $estadoinverso,$fecha){
            
            $this->usuarios = new Usuario();
            $usuarios->setId($idusuario);

            $this->estados = new Estado();
            $estados->setDescripcion($estado);
            $estadoin->setDescripcion($estadoinverso);
            
            $this->conectar();
            $this->query = "call empleadoUsuarioDesactivar`(
                                '$this->codigo', 
                                '$usuarios->getId()', 
                                '$estados->getDescripcion()', 
                                '$this->IdFoto', 
                                '$estadoin->getDescripcion()', 
                                '$fecha')";
			$this->conexion->query($this->query);
			$this->desconectar();
        }

        public function verEmpleados(){
            $this->conectar();
    
            $this->query = "SELECT 
                                empleado.`codigoEmpleado` 'codigoempleado',
                                empleado.`identificacionEmpleado` 'identificacionempleado',
                                identificacion.descripcionIdentificacion 'tipoidentificacion',
                                empleado.`nombreEmpleado` 'nombreempleado',
                                empleado.`apellidoEmpleado` 'apellidoempleado',
                                empleado.`telefonoEmpleado` 'telefonoempleado',
                                empleado.`correoEmpleado` 'correoempleado',
                                empleado.fechaNacimiento 'nacimiento',
                                empleado.fechaEntrada 'entrada',
                                sexo.descripcionSexo 'genero',
                                foto.enlaceFoto 'foto',
                                foto.idFotoEmpleado 'idFoto',
                                area.nombreArea 'nombrearea',
                                area.idArea 'idarea',
                                facultad.nombreFacultad 'nombrefacultad',
                                facultad.idFacultad 'idfacultad'
                            FROM EMPLEADOS AS empleado
                            inner join SEXOS AS sexo on empleado.idSexo = sexo.idSexo
                            inner join IDENTIFICACIONES AS identificacion on empleado.idIdentificacion = identificacion.idIdentificacion
                            inner join ESTADOS AS estado on empleado.idEstado = estado.idEstado
                            inner join AREAEMPLEADOS AS areaemp on empleado.codigoEmpleado = areaemp.codigoEmpleado
                            inner join AREAS AS area on areaemp.idArea = area.idArea
                            inner join FOTOEMPLEADOS as foto on empleado.codigoEmpleado = foto.codigoEmpleado
                            inner join FACULTADES as facultad on area.idFacultad = facultad.idFacultad";

            $resultSet = mysqli_query($this->conexion, $this->query);

            $this->empleados = array();

            while($fila = mysqli_fetch_array($resultSet)){
                $arreglo = array(
                    'identificacionempleado'=>$fila['identificacionempleado'],
                    'tipoidentificacion'=>$fila['tipoidentificacion'],
                    'nombreempleado'=>$fila['nombreempleado'],
                    'apellidoempleado'=>$fila['apellidoempleado'],
                    'telefonoempleado'=>$fila['telefonoempleado'],
                    'correoempleado'=>$fila['correoempleado'],
                    'nacimiento'=>$fila['nacimiento'],
                    'entrada'=>$fila['entrada'],
                    'genero'=>$fila['genero'],
                    'foto'=>$fila['foto'],
                    'idFoto'=>$fila['idFoto'],
                    'nombrearea'=>$fila['nombrearea'],
                    'idarea'=>$fila['idarea'],
                    'nombrefacultad'=>$fila['nombrefacultad'],
                    'idfacultad'=>$fila['idfacultad']

                );

                array_push($this->empleados, $arreglo);
            }
            $this->desconectar();
        }
        
        
        public function verEmpleadosActivos($estado, $area, $facultad){
            $this->estados = new Estado();
            $estados->setDesripcion($estado);

            $this->areas = new Area();
            $areas->setNombre($area);

            $this->facultades = new Facultad();
            $facultades->setNombre($facultad);
            
            $this->conectar();
    
            $this->query = "SELECT 
            empleado.`codigoEmpleado` 'codigoempleado',
            empleado.`identificacionEmpleado` 'identificacionempleado',
            identificacion.descripcionIdentificacion 'tipoidentificacion',
            empleado.`nombreEmpleado` 'nombreempleado',
            empleado.`apellidoEmpleado` 'apellidoempleado',
            empleado.`telefonoEmpleado` 'telefonoempleado',
            empleado.`correoEmpleado` 'correoempleado',
            empleado.fechaNacimiento 'nacimiento',
            empleado.fechaEntrada 'entrada',
            sexo.descripcionSexo 'genero',
            foto.enlaceFoto 'foto',
            foto.idFotoEmpleado 'idFoto',
            area.nombreArea 'nombrearea',
            area.idArea 'idarea',
            facultad.nombreFacultad 'nombrefacultad',
            facultad.idFacultad 'idfacultad'
        FROM EMPLEADOS AS empleado
        inner join SEXOS AS sexo on empleado.idSexo = sexo.idSexo
        inner join IDENTIFICACIONES AS identificacion on empleado.idIdentificacion = identificacion.idIdentificacion
        inner join ESTADOS AS estado on empleado.idEstado = estado.idEstado
        inner join AREAEMPLEADOS AS areaemp on empleado.codigoEmpleado = areaemp.codigoEmpleado
        inner join AREAS AS area on areaemp.idArea = area.idArea
        inner join FOTOEMPLEADOS as foto on empleado.codigoEmpleado = foto.codigoEmpleado
        inner join FACULTADES as facultad on area.idFacultad = facultad.idFacultad
        WHERE (estado.descripcionEstado = '$estados->getDescripcion()' and area.nombreArea = '$areas->getNombre()' and facultad.nombreFacultad = '$facultades->getNombre()');";

            $resultSet = mysqli_query($this->conexion, $this->query);

            $this->empleados = array();

            while($fila = mysqli_fetch_array($resultSet)){
                $arreglo = array(
                    'identificacionempleado'=>$fila['identificacionempleado'],
                    'tipoidentificacion'=>$fila['tipoidentificacion'],
                    'nombreempleado'=>$fila['nombreempleado'],
                    'apellidoempleado'=>$fila['apellidoempleado'],
                    'telefonoempleado'=>$fila['telefonoempleado'],
                    'correoempleado'=>$fila['correoempleado'],
                    'nacimiento'=>$fila['nacimiento'],
                    'entrada'=>$fila['entrada'],
                    'genero'=>$fila['genero'],
                    'foto'=>$fila['foto'],
                    'idFoto'=>$fila['idFoto'],
                    'nombrearea'=>$fila['nombrearea'],
                    'idarea'=>$fila['idarea'],
                    'nombrefacultad'=>$fila['nombrefacultad'],
                    'idfacultad'=>$fila['idfacultad']

                );

                array_push($this->empleados, $arreglo);
            }
            $this->desconectar();
        }


    }
?>