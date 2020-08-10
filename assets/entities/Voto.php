<?php

    class Voto
    {
        public $id;
        public $presidente;
        public $alcalde;
        public $senador;
        public $diputado;
    
        public function __construct()
        {
            
        }
        public function set($data){
            foreach ($data as $key => $value) $this->{$key} = $value;
        }
    
        public function initializeData($id, $nombre, $descripcion, $logo, $estado){
    
            $this->id = $id;
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->logo = $logo;
            $this->estado = $estado;
        }
    }

?>