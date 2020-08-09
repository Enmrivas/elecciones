<?php

class Candidato{

    public $id;
    public $nombre;
    public $apellido;
    public $partido;
    public $puesto;
    public $fotoPerfil;
    public $estado;

    public function __construct()
    {
        
    }
    public function set($data){
        foreach ($data as $key => $value) $this->{$key} = $value;
    }

    public function initializeData($id, $nombre, $apellido, $partido, $puesto, $estado){

        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->partido = $partido;
        $this->estado = $estado;
        $this->puesto = $puesto;
    }
}
?>