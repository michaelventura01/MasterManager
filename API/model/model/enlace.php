<?php

class enlace
{
    //version 1.0
    //ultima modificacion: 30 abril 

	private $idenlace;
    private $nombreEnlace;
    private $urlEnlace;
    private $idEstado;

	public function __construct($idenlace,$nombreEnlace,$urlEnlace,$idEstado)
    {
       $this->_idenlace = $idenlace;
       $this->_nombreEnlace = $nombreEnlace;
       $this->_urlEnlace = $urlEnlace;
       $this->_idEstado = $idEstado;    
    }
    public function getidenlace()
    {
    	return $this->_idenlace;
    }
    public function getnombreEnlace()
    {
        return $this->_idenlace;
    }
    public function geturlEnlace()
    {
        return $this->_urlEnlace;
    }
    public function getidEstado()
    {
        return $this->_idEstado;
    }
    
    
}

?>