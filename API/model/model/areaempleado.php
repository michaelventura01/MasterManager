<?php

class areaEmpleado
{
    private idArea;
    private nombreArea;
    private idFacultad;
    private idEstado;

    public function __construct($idArea,$nombreArea,$idFacultad,$idEstado)
    {
        $this->_idArea = $idArea;
        $this->_nombreArea = $nombreArea;
        $this->_idFacultad = $idFacultad;
        $this->_idEstado = $idEstado;
    }
    public function getidArea()
    {
        return $this->_idArea;
    }
    public function getnombreArea()
    {
        return $this->_nombreArea;
    }
    public function getidFacultad()
    {
        return $this->_idFacultad;
    }
    public function getidEstado()
    {
        return $this->_idEstado;
    }
}

?>

