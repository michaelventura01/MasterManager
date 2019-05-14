<?php
    include_once("conexion.php");
    include_once("estado.php");
    include_once("area.php");
    include_once("rol.php");
    include_once("empleado.php");
    
    class Usuario extends Conexion{
        
        private $id;	
        private $usuario;//descripcion
        private $clave;

        private $usuarios;

        //relacion
        private $estados;	
        private $roles;	
        private $empleados;
        private $areas;

        public  function setId($id){
            $this->id = $id;
        }	
        public  function setUsuario($usuario){
            $this->usuario = $usuario;
        }	
        public  function setClave($clave){
            $this->clave = $clave;
        }

        public function getUsuarios(){
            return $this->usuarios;
        }

        public  function getId(){
            return $this->id;
        }	
        public  function getUsuario(){
            return $this->usuario;
        }	
        public  function getClave(){
            return $this->clave;
        }

        public function verUsuarios(){
            
            $this->conectar();

			$this->query = "SELECT 
                                usuario.`descripcionUsuario` 'user',
                                usuario.`claveUsuario` 'password',
                                usuario.idUsuario 'idUsuario',
                                estado.descripcionEstado 'estado',
                                rol.descripcionRol 'rolusuario',
                                empleado.nombreEmpleado 'nombreempleado',
                                empleado.apellidoEmpleado 'apellidoempleado',
                                empleado.codigoEmpleado 'codigoempleado',
                                sexo.descripcionSexo 'genero',
                                area.nombreArea 'area',
                                facultad.nombreFacultad 'facultad',
                                facultad.idFacultad 'idFacultad',
                                foto.enlaceFoto 'foto',
                                foto.idFotoEmpleado 'idFoto'
                            FROM USUARIOS AS usuario 
                            inner join ESTADOS AS estado on usuario.idEstado = estado.idEstado
                            inner join ROLES AS rol on usuario.idRol = rol.idRol
                            inner join EMPLEADOS AS empleado on usuario.codigoEmpleado = empleado.codigoEmpleado
                            inner join SEXOS AS sexo on empleado.idSexo = sexo.idSexo
                            inner join AREAEMPLEADOS AS areaemp on empleado.codigoEmpleado = areaemp.codigoEmpleado
                            inner join AREAS AS area on areaemp.idArea = area.idArea
                            inner join FACULTADES AS facultad on area.idFacultad = facultad.idFacultad
                            inner join FOTOEMPLEADOS as foto on empleado.codigoEmpleado = foto.codigoEmpleado
                            GROUP BY area.nombreArea;";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->usuarios = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'user' => $fila['user'],
                    'password' => $fila['password'],
                    'idUsuario' => $fila['idUsuario'],
                    'estado' => $fila['estado'],
                    'rolusuario' => $fila['rolusuario'],
                    'nombreempleado' => $fila['nombreempleado'],
                    'apellidoempleado' => $fila['apellidoempleado'],
                    'codigoempleado' => $fila['codigoempleado'],
                    'genero' => $fila['genero'],
                    'area' => $fila['area'],
                    'facultad' => $fila['facultad'],
                    'idFacultad' => $fila['idFacultad'],
                    'foto' => $fila['foto'],
                    'idFoto' => $fila['idFoto']
				);
				array_push($this->usuarios, $arreglo);
            }
            
            $this->desconectar();
        }
        
        public function verUsuariosActivos($area, $estado){

            $this->areas = new Area();
            $areas->setNombre($area);

            $this->estados = new Estado();
            $estados->setDescripcion($estado);
                        
            $this->conectar();

			$this->query = "SELECT 
                                usuario.`descripcionUsuario` 'user',
                                usuario.`claveUsuario` 'password',
                                estado.descripcionEstado 'estado',
                                rol.descripcionRol 'rolusuario',
                                empleado.nombreEmpleado 'nombreempleado',
                                empleado.apellidoEmpleado 'apellidoempleado',
                                empleado.codigoEmpleado 'codigoempleado',
                                sexo.descripcionSexo 'genero',
                                area.nombreArea 'area',
                                facultad.nombreFacultad 'facultad',
                                facultad.idFacultad 'idFacultad',
                                foto.enlaceFoto 'foto',
                                foto.idFotoEmpleado 'idFoto'
                            FROM USUARIOS AS usuario 
                            inner join ESTADOS AS estado on usuario.idEstado = estado.idEstado
                            inner join ROLES AS rol on usuario.idRol = rol.idRol
                            inner join EMPLEADOS AS empleado on usuario.codigoEmpleado = empleado.codigoEmpleado
                            inner join SEXOS AS sexo on empleado.idSexo = sexo.idSexo
                            inner join AREAEMPLEADOS AS areaemp on empleado.codigoEmpleado = areaemp.codigoEmpleado
                            inner join AREAS AS area on areaemp.idArea = area.idArea
                            inner join FACULTADES AS facultad on area.idFacultad = facultad.idFacultad
                            inner join FOTOEMPLEADOS as foto on empleado.codigoEmpleado = foto.codigoEmpleado
                            WHERE estado.descripcionEstado = '$estados->getDescripcion()' AND area.nombreArea = '$areas->getNombre()'
                            GROUP BY area.nombreArea;";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->usuarios = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'user' => $fila['user'],
                    'password' => $fila['password'],
                    'idUsuario' => $fila['idUsuario'],
                    'estado' => $fila['estado'],
                    'rolusuario' => $fila['rolusuario'],
                    'nombreempleado' => $fila['nombreempleado'],
                    'apellidoempleado' => $fila['apellidoempleado'],
                    'codigoempleado' => $fila['codigoempleado'],
                    'genero' => $fila['genero'],
                    'area' => $fila['area'],
                    'facultad' => $fila['facultad'],
                    'idFacultad' => $fila['idFacultad'],
                    'foto' => $fila['foto'],
                    'idFoto' => $fila['idFoto']
				);
				array_push($this->usuarios, $arreglo);
            }
            
            $this->desconectar();
        }

        public function verUsuario($estado){

            $this->estados = new Estado();
            $estados->setDescripcion($estado);
                        
            $this->conectar();

			$this->query = "SELECT 
                                usuario.`descripcionUsuario` 'user',
                                usuario.`claveUsuario` 'password',
                                estado.descripcionEstado 'estado',
                                rol.descripcionRol 'rolusuario',
                                empleado.nombreEmpleado 'nombreempleado',
                                empleado.apellidoEmpleado 'apellidoempleado',
                                empleado.codigoEmpleado 'codigoempleado',
                                sexo.descripcionSexo 'genero',
                                area.nombreArea 'area',
                                facultad.nombreFacultad 'facultad',
                                facultad.idFacultad 'idFacultad',
                                foto.enlaceFoto 'foto',
                                foto.idFotoEmpleado 'idFoto'
                            FROM USUARIOS AS usuario 
                            inner join ESTADOS AS estado on usuario.idEstado = estado.idEstado
                            inner join ROLES AS rol on usuario.idRol = rol.idRol
                            inner join EMPLEADOS AS empleado on usuario.codigoEmpleado = empleado.codigoEmpleado
                            inner join SEXOS AS sexo on empleado.idSexo = sexo.idSexo
                            inner join AREAEMPLEADOS AS areaemp on empleado.codigoEmpleado = areaemp.codigoEmpleado
                            inner join AREAS AS area on areaemp.idArea = area.idArea
                            inner join FACULTADES AS facultad on area.idFacultad = facultad.idFacultad
                            inner join FOTOEMPLEADOS as foto on empleado.codigoEmpleado = foto.codigoEmpleado
                            WHERE usuario.descripcionUsuario = '$this->usuario' AND usuario.claveUsuario = '$this->clave' AND estado.descripcionEstado = '$estados->getDescripcion()';";

			$resultSet = mysqli_query($this->conexion, $this->query);

            $this->usuarios = array();

			while($fila = mysqli_fetch_array($resultSet)){
				$arreglo = array(
					'user' => $fila['user'],
                    'password' => $fila['password'],
                    'idUsuario' => $fila['idUsuario'],
                    'estado' => $fila['estado'],
                    'rolusuario' => $fila['rolusuario'],
                    'nombreempleado' => $fila['nombreempleado'],
                    'apellidoempleado' => $fila['apellidoempleado'],
                    'codigoempleado' => $fila['codigoempleado'],
                    'genero' => $fila['genero'],
                    'area' => $fila['area'],
                    'facultad' => $fila['facultad'],
                    'idFacultad' => $fila['idFacultad'],
                    'foto' => $fila['foto'],
                    'idFoto' => $fila['idFoto']
				);
				array_push($this->usuarios, $arreglo);
            }
            
            $this->desconectar();
        }

    } 
?>