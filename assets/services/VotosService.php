<?php
class VotosService
{

    private $context;

    public function __construct($directory)
    {
        $this->context = new DatabaseContext($directory);
    }
    

    public function GetList(){

        $listCuentas = array();

        $stmnt = $this->context->db->prepare("Select * from votos");
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
}
?>