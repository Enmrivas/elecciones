<?php
class UserService
{

    private $context;

    public function __construct($directory)
    {
        $this->context = new DatabaseContext($directory);
    }
    
    public function Login($cedula)
    {
        $stmnt = $this->context->db->prepare("Select * from users where cedula = ?");
        $stmnt->bind_param("s", $cedula);
        $stmnt->execute();
        $result = $stmnt->get_result();
        
        if($result->num_rows === 0)
        {
            return null;
        }
        else
        {
            $entidad = $result->fetch_object();
            $user = new Users();
            
            $user->cedula = $entidad->cedula;
            $user->nombre = $entidad->nombre;
            $user->apellido = $entidad->apellido;
            $user->email = $entidad->email;
            $user->estado = $entidad->estado;
            
            return $user;
        }
    }

    public function GetList(){

        $listCuentas = array();

        $stmnt = $this->context->db->prepare("Select * from users");
        $stmnt->execute();

        $result = $stmnt->get_result();

        if($result->num_rows === 0){
            return $listCuentas;
        }else{

            while($entidad = $result->fetch_object()){

                $user = new Users();
                $user->cedula = $entidad->cedula;
                $user->nombre = $entidad->nombre;
                $user->apellido = $entidad->apellido;
                $user->email = $entidad->email;
                $user->estado = $entidad->estado;

                array_push($listCuentas, $user);

            }

        }
        $stmnt->close();
        return $listCuentas;

    }

    public function GetByCedula($cedula){

        $user = new Users();

        $stmnt = $this->context->db->prepare("Select * from users where cedula = ?");
        $stmnt->bind_param("s", $cedula);
        $stmnt->execute();

        $result = $stmnt->get_result();

        if($result->num_rows === 0){
            return null;
        }else{

            while($entidad = $result->fetch_object()){

                $user->cedula = $entidad->cedula;
                $user->nombre = $entidad->nombre;
                $user->apellido = $entidad->apellido;
                $user->email = $entidad->email;
                $user->estado = $entidad->estado;

            }

        }
        $stmnt->close();
        return $user;

    }

    public function Add($entidad){

        $stmnt = $this->context->db->prepare("Insert into users (cedula, nombre, apellido, email, estado) values (?,?,?,?,?)");
        $stmnt->bind_param("sssss", $entidad->cedula, $entidad->nombre, $entidad->apellido, $entidad->email, $entidad->estado);
        $stmnt->execute();
        $stmnt->close();

    }

    public function Update($cedula, $entidad){

        $stmnt = $this->context->db->prepare("update users set nombre = ?, apellido = ?, email = ?, estado = ? where cedula = ?");
        $stmnt->bind_param("sssss", $entidad->nombre, $entidad->apellido, $entidad->email, $entidad->estado, $cedula);
        $stmnt->execute();
        $stmnt->close();
    }

    public function Delete($cedula){

        $stmnt = $this->context->db->prepare("delete from users where cedula = ?");
        $stmnt->bind_param("s", $cedula);
        $stmnt->execute();
        $stmnt->close();

    }

    
}

?>