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

                $user = new Voto();
                $user->id = $entidad->id;
                $user->presidente = $entidad->presidente;
                $user->alcalde= $entidad->alcalde;
                $user->senador = $entidad->senador;
                $user->diputado = $entidad->diputado;

                array_push($listCuentas, $user);

            }

        }
        $stmnt->close();
        return $listCuentas;

    }
    public function Add($entidad){

        $stmnt = $this->context->db->prepare("Insert into votos (presidente, alcalde, senador, diputado) values (?,?,?,?)");
        $stmnt->bind_param("ssss", $entidad->presidente, $entidad->alcalde, $entidad->senador, $entidad->diputado);
        $stmnt->execute();
        $stmnt->close();

    }
}
?>