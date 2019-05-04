<?php

class documento
{
    //version 1.0
    //ultima modificacion: 30 abril 

	private $idDocumento;
    private $idTipoDocumento;
	private $fechaDocumento;
	private $horaDocumento;
	private $idArea;
    private $descripcionDocumento;
    private $idEstado;
    private $areaVia;
    private $codigoEmpleado; 


	public function __construct($idDocumento,$idTipoDocumento,$fechaDocumento,$horaDocumento,$idArea,$descripcionDocumento,$idEstado,$areaVia,$codigoEmpleado )
    {
       $this->_idDocumento = $idDocumento;
       $this->_idTipoDocumento = $idTipoDocumento;
       $this->_fechaDocumento = $fechaDocumento;
       $this->_horaDocumento = $horaDocumento;
       $this->_idArea = $idArea;
       $this->_descripcionDocumento = $descripcionDocumento;
       $this->_idEstado = $idEstado;
       $this->_areaVia = $areaVia;
       $this->_codigoEmpleado = $codigoEmpleado; 
    }
    public function getidDocumento()
    {
    	return $this->_idDocumento;
    }
    public function getidTipoDocumento()
    {
        return $this->_idTipoDocumento;
    }
    public function getfechaDocumento()
    {
        return $this->_fechaDocumento;
    }
    public function gethoraDocumento()
    {
        return $this->;
    }
    public function getidArea()
    {
        return $this->_idArea;
    }
    public function getdescripcionDocumento()
    {
        return $this->_descripcionDocumento;
    }
    public function getidEstado()
    {
        return $this->_idEstado;
    }
    public function getareaVia()
    {
        return $this->_areaVia;
    }
    public function getcodigoEmpleado()
    {
        return $this->_codigoEmpleado;
    }
    
}

?>