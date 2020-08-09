<?php 

class Users{

    public $cedula;
    public $nombre;
    public $apellido;
    public $email;
    public $estado;
    public $admin;


    public function __construct()
    {
        
    }
    public function set($data){
        foreach ($data as $key => $value) $this->{$key} = $value;
    }

    public function initializeData($cedula, $nombre, $apellido, $email, $estado, $admin){
        $this->cedula = $cedula;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->estado = $estado;
        $this->admin = $admin;
    }
}


?>