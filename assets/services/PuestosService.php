<?php
class PuestosService
{

    private $context;

    public function __construct($directory)
    {
        $this->context = new DatabaseContext($directory);
    }
    

    public function GetList(){

        $listCuentas = array();

        $stmnt = $this->context->db->prepare("Select * from puesto");
        $stmnt->execute();

        $result = $stmnt->get_result();

        if($result->num_rows === 0){
            return $listCuentas;
        }else{

            while($entidad = $result->fetch_object()){

                $user = new Puesto();
                $user->id = $entidad->id;
                $user->nombre = $entidad->nombre;
                $user->descripcion= $entidad->descripcion;
                $user->estado = $entidad->estado;

                array_push($listCuentas, $user);

            }

        }
        $stmnt->close();
        return $listCuentas;

    }

    public function GetById($id){

        $user = new Puesto();

        $stmnt = $this->context->db->prepare("Select * from puesto where id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();

        $result = $stmnt->get_result();

        if($result->num_rows === 0){
            return null;
        }else{

            while($entidad = $result->fetch_object()){

                $user->id = $entidad->id;
                $user->nombre = $entidad->nombre;
                $user->descripcion = $entidad->descripcion;
                $user->estado = $entidad->estado;

            }

        }
        $stmnt->close();
        return $user;

    }
    public function GetEstado(){

        $listCuentas = array();

        $stmnt = $this->context->db->prepare("Select * from puesto where estado = 'activo'");
        $stmnt->execute();

        $result = $stmnt->get_result();

        if($result->num_rows === 0){
            return $listCuentas;
        }else{

            while($entidad = $result->fetch_object()){

                $user = new Partido();
                $user->id = $entidad->id;
                $user->nombre = $entidad->nombre;
                $user->descripcion= $entidad->descripcion;
                $user->estado = $entidad->estado;

                array_push($listCuentas, $user);

            }

        }
        $stmnt->close();
        return $listCuentas;

    }

    public function Add($entidad){

        $stmnt = $this->context->db->prepare("Insert into puesto(nombre, descripcion, estado) values (?,?,?)");
        $stmnt->bind_param("sss", $entidad->nombre, $entidad->descripcion, $entidad->estado);
        $stmnt->execute();
        $stmnt->close();

    }

    public function Update($id, $entidad){

        $stmnt = $this->context->db->prepare("update puesto set nombre = ?, descripcion = ?, estado = ? where id = ?");
        $stmnt->bind_param("sssi", $entidad->nombre, $entidad->descripcion, $entidad->estado, $id);
        $stmnt->execute();
        $stmnt->close();
    }

    public function Delete($id){

        $stmnt = $this->context->db->prepare("delete from puesto where id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $stmnt->close();

    }

    
}

?>