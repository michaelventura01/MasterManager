<?php

class empleado
{
    //version 1.0
    //ultima modificacion: 30 abril 

	private $codigoEmpleado;
    private $identificacionEmpleado;
    private $nombreEmpleado;
    private $apellidoEmpleado;
    private $idIdentificacion;
    private $telefonoEmpleado;
    private $correoEmpleado;
    private $idEstado;


	public function __construct($codigoEmpleado,$identificacionEmpleado,$nombreEmpleado,$apellidoEmpleado,$idIdentificacion,$telefonoEmpleado,$correoEmpleado,$idEstado)
    {
       $this->_codigoEmpleado = $codigoEmpleado;
       $this->_identificacionEmpleado = $identificacionEmpleado;
       $this->_nombreEmpleado = $nombreEmpleado;
       $this->_apellidoEmpleado = $apellidoEmpleado;
       $this->_idIdentificacion = $idIdentificacion;
       $this->_telefonoEmpleado = $telefonoEmpleado;
       $this->_correoEmpleado = $correoEmpleado;
       $this->_idEstado =$idEstado;
       
    }
    public function getcodigoEmpleado()
    {
    	return $this->_codigoEmpleado;
    }
    public function getidentificacionEmpleado()
    {
        return $this->_identificacionEmpleado;
    }
    public function getnombreEmpleado()
    {
        return $this->_nombreEmpleado;
    }
    public function getapellidoEmpleado()
    {
        return $this->_apellidoEmpleado;
    }
    public function getidIdentificacion()
    {
        return $this->_idIdentificacion;
    }
    public function gettelefonoEmpleado()
    {
        return $this->_telefonoEmpleado;
    }
    public function getcorreoEmpleado()
    {
        return $this->_correoEmpleado;
    }
    public function getidEstado ()
    {
        return $this->_idEstado ;
    }
     
}

?>