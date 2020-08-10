<?php
class PartidoService
{

    private $context;

    public function __construct($directory)
    {
        $this->context = new DatabaseContext($directory);
    }
    

    public function GetList(){

        $listCuentas = array();

        $stmnt = $this->context->db->prepare("Select * from partidos");
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
                $user->logo = $entidad->logo;
                $user->estado = $entidad->estado;

                array_push($listCuentas, $user);

            }

        }
        $stmnt->close();
        return $listCuentas;

    }
    public function GetEstado(){

        $listCuentas = array();

        $stmnt = $this->context->db->prepare("Select * from partidos where estado = 'activo'");
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
                $user->logo = $entidad->logo;
                $user->estado = $entidad->estado;

                array_push($listCuentas, $user);

            }

        }
        $stmnt->close();
        return $listCuentas;

    }

    public function GetById($id){

        $user = new Partido();

        $stmnt = $this->context->db->prepare("Select * from partidos where id = ?");
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
                $user->logo = $entidad->logo;
                $user->estado = $entidad->estado;

            }

        }
        $stmnt->close();
        return $user;

    }
    
    public function Add($entidad){

        $stmnt = $this->context->db->prepare("Insert into partidos(nombre, descripcion, logo, estado) values (?,?,?,?)");
        $stmnt->bind_param("ssss", $entidad->nombre, $entidad->descripcion, $entidad->logo, $entidad->estado);
        $stmnt->execute();
        $stmnt->close();

    }

    public function Update($id, $entidad){

        $stmnt = $this->context->db->prepare("update partidos set nombre = ?, descripcion = ?, logo = ?, estado = ? where id = ?");
        $stmnt->bind_param("ssssi", $entidad->nombre, $entidad->descripcion, $entidad->logo, $entidad->estado, $id);
        $stmnt->execute();
        $stmnt->close();
    }

    public function Delete($id){

        $stmnt = $this->context->db->prepare("delete from partidos where id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $stmnt->close();

    }

    
}

?>