<?php

class enlacerol
{
    //version 1.0
    //ultima modificacion: 30 abril 

	private $idEnlaceRol;
    private $idEnlace;
    private $idRol;
   

	public function __construct($idEnlaceRol,$idEnlace,$idRol)
    {
       $this->_idEnlaceRol = $idEnlaceRol;
       $this->_idEnlace = $idEnlace;
       $this->_idRol = $idRol; 
    }
    public function getidEnlaceRol()
    {
    	return $this->_idEnlaceRol;
    }
    public function getidEnlace()
    {
        return $this->_idenlace;
    }
    public function getidRol()
    {
        return $this->_idRol;
    }  
}

?>