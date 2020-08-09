<?php
class AdminService
{

    private $context;

    public function __construct($directory)
    {
        $this->context = new DatabaseContext($directory);
    }
    
    public function Login($username, $pass)
    {
        $stmnt = $this->context->db->prepare("Select * from admin where usuario = ? and pass = ?");
        $stmnt->bind_param("ss", $username, $pass);
        $stmnt->execute();
        $result = $stmnt->get_result();
        
        if($result->num_rows === 0)
        {
            return null;
        }
        else
        {
            $entidad = $result->fetch_object();
            $user = new UserAdmin();
            
            $user->id = $entidad->id;
            $user->nombre = $entidad->nombre;
            $user->apellido = $entidad->apellido;
            $user->correo = $entidad->correo;
            $user->usuario = $entidad->usuario;
            $user->pass = $entidad->pass;
            
            return $user;
        }
    }

    public function GetList(){

        $listCuentas = array();

        $stmnt = $this->context->db->prepare("Select * from admin");
        $stmnt->execute();

        $result = $stmnt->get_result();

        if($result->num_rows === 0){
            return $listCuentas;
        }else{

            while($entidad = $result->fetch_object()){

                $user = new UserAdmin();
                $user->id = $entidad->id;
                $user->nombre = $entidad->nombre;
                $user->apellido = $entidad->apellido;
                $user->correo = $entidad->correo;
                $user->usuario = $entidad->usuario;
                $user->pass = $entidad->pass;

                array_push($listCuentas, $user);

            }

        }
        $stmnt->close();
        return $listCuentas;

    }

    public function GetById($id){

        $user = new UserAdmin();

        $stmnt = $this->context->db->prepare("Select * from admin where id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();

        $result = $stmnt->get_result();

        if($result->num_rows === 0){
            return null;
        }else{

            while($entidad = $result->fetch_object()){

                $user->id = $entidad->id;
                $user->nombre = $entidad->nombre;
                $user->apellido = $entidad->apellido;
                $user->correo = $entidad->correo;
                $user->usuario = $entidad->usuario;
                $user->pass = $entidad->pass;

            }

        }
        $stmnt->close();
        return $user;

    }

    public function Add($entidad){

        $stmnt = $this->context->db->prepare("Insert into admin (nombre, apellido, correo, usuario, pass) values (?,?,?,?,?)");
        $stmnt->bind_param("sssss", $entidad->nombre, $entidad->apellido, $entidad->correo, $entidad->usuario, $entidad->pass);
        $stmnt->execute();
        $stmnt->close();

    }

    public function Update($cedula, $entidad){

        $stmnt = $this->context->db->prepare("update admin set nombre = ?, apellido = ?, correo = ?, usuario = ?, pass = ? where id = ?");
        $stmnt->bind_param("sssssi", $entidad->nombre, $entidad->apellido, $entidad->correo, $entidad->usuario, $entidad->pass, $id);
        $stmnt->execute();
        $stmnt->close();
    }

    public function Delete($id){

        $stmnt = $this->context->db->prepare("delete from admin where id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $stmnt->close();

    }

    
}

?>