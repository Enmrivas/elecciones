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
    
        public function initializeData($id, $presidente, $alcalde, $senador, $diputado){
    
            $this->id = $id;
            $this->presidente = $presidente;
            $this->alcalde = $alcalde;
            $this->senador = $senador;
            $this->diputado = $diputado;
        }
    }

?>