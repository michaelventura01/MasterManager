<?php

class cargo
{
    //version 1.0
    //ultima modificacion: 29 abril 
    
	private $idCargo;
	private $descripcionCargo;
	private $idEstado;

	public function __construct($idCargo,$descripcionCargo,$idEstado)
    {
        $this->_idCargo = $idCargo;
        $this->_descripcionCargo = $descripcionCargo;
        $this->_idEstado = $idEstado;
        
    }
    public function getidCargo()
    {
    	return $this->_idCargo;
    }
    public function getdescripcionCargo()
    {
    	return $this->_descripcionCargo;
    }
    public function getidEstado()
    {
    	return $this->_idEstado;
    }
  
}

?>