<?php

class Puesto{

    public $id;
    public $nombre;
    public $descripcion;
    public $estado;

    public function __construct()
    {
        
    }
    public function set($data){
        foreach ($data as $key => $value) $this->{$key} = $value;
    }

    public function initializeData($id, $nombre, $descripcion, $estado){

        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
    }
}
?>