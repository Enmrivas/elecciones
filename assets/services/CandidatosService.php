<?php
class CandidatosService
{
    private $utilities;
    private $context;

    public function __construct($directory)
    {
        $this->context = new DatabaseContext($directory);
        $this->utilities = new Utilities();
    }

    public function GetList(){

        $listCandidatos = array();

        $stmnt = $this->context->db->prepare("Select * from candidatos");
        $stmnt->execute();

        $result = $stmnt->get_result();

        if($result->num_rows === 0){
            return $listCandidatos;
        }else{

            while($entidad = $result->fetch_object()){

                $user = new Candidato();
                $user->id = $entidad->id;
                $user->nombre = $entidad->nombre;
                $user->apellido = $entidad->apellido;
                $user->partido = $entidad->partido;
                $user->puesto = $entidad->puesto;
                $user->estado = $entidad->estado;

                array_push($listCandidatos, $user);

            }

        }
        $stmnt->close();
        return $listCandidatos;

    }
    public function GetEstado(){

        $listCandidatos = array();

        $stmnt = $this->context->db->prepare("Select * from candidatos where estado = 'activo'");
        $stmnt->execute();

        $result = $stmnt->get_result();

        if($result->num_rows === 0){
            return $listCandidatos;
        }else{

            while($entidad = $result->fetch_object()){

                $user = new Candidato();
                
                $user->id = $entidad->id;
                $user->nombre = $entidad->nombre;
                $user->apellido = $entidad->apellido;
                $user->partido = $entidad->partido;
                $user->puesto = $entidad->puesto;
                $user->estado = $entidad->estado;

                array_push($listCandidatos, $user);

            }

        }
        $stmnt->close();
        return $listCandidatos;

    }

    public function GetById($id){

        $user = new Candidato();

        $stmnt = $this->context->db->prepare("Select * from candidatos where id = ?");
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
                $user->partido = $entidad->partido;
                $user->puesto = $entidad->puesto;
                $user->estado = $entidad->estado;

            }

        }
        $stmnt->close();
        return $user;

    }

    public function Add($entidad){

        $stmnt = $this->context->db->prepare("Insert into candidatos (nombre, apellido, partido, puesto, estado) values (?,?,?,?,?)");
        $stmnt->bind_param("sssss", $entidad->nombre, $entidad->apellido, $entidad->partido, $entidad->puesto, $entidad->estado);
        $stmnt->execute();
        $stmnt->close();

        $accountID = $this->context->db->insert_id;

        if(isset($_FILES['fotoPerfil'])){

            $fotoFile = $_FILES['fotoPerfil'];

            if($fotoFile['error'] == 4){
                $entidad->fotoPerfil = "";
            }else{
                $typeReplace = str_replace("image/", "", $_FILES['fotoPerfil']['type']); 
                $type = $fotoFile['type'];
                $size = $fotoFile['size'];
                $nombre = $accountID . '.' . $typeReplace;
                $tmpname = $fotoFile['tmp_name'];

                $success = $this->utilities->agregarImagen('image/', $nombre, $tmpname, $type, $size);

                if($success){
                    $stmnt = $this->context->db->prepare("update candidatos set fotoPerfil = ? where id = ?");
                    $stmnt->bind_param("si", $nombre, $accountID);
                    $stmnt->execute();
                    $stmnt->close();
                }
            }

        }

    }

    public function Update($id, $entidad){

        $element = $this->GetById($id);

        $stmnt = $this->context->db->prepare("update candidatos set nombre = ?, apellido = ?, partido = ?, puesto = ?, estado = ? where id = ?");
        $stmnt->bind_param("sssssi", $entidad->nombre, $entidad->apellido, $entidad->partido, $entidad->puesto, $entidad->estado, $id);
        $stmnt->execute();
        $stmnt->close();

        if(isset($_FILES['fotoPerfil'])){

            $fotoFile = $_FILES['fotoPerfil'];

            if($fotoFile['error'] == 4){

                $entidad->fotoPerfil = $element->fotoPerfil;

            }else{
                $typeReplace = str_replace("image/", "", $fotoFile['type']); 
                $type = $fotoFile['type'];
                $size = $fotoFile['size'];
                $nombre = $id . '.' . $typeReplace;
                $tmpFile = $fotoFile['tmp_name'];
    
                $success = $this->utilities->agregarImagen('image/', $nombre, $tmpFile, $type, $size);
    
                if($success){
                    $stmnt = $this->context->db->prepare("update candidatos set fotoPerfil = ? where id = ?");
                    $stmnt->bind_param("si", $nombre, $id);
                    $stmnt->execute();
                    $stmnt->close();
                }
            }

            

        }
    }

    public function Delete($id){

        $stmnt = $this->context->db->prepare("delete from candidatos where id = ?");
        $stmnt->bind_param("i", $id);
        $stmnt->execute();
        $stmnt->close();

    }

    
}

?>