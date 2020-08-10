<?php 
    require_once 'assets/helpers/FileHandler/JsonFileHandler.php';
    require_once 'assets/helpers/FileHandler/IFileHandler.php';
    require_once 'assets/database/DatabaseContext.php';
    require_once 'assets/entities/User.php';
    require_once 'assets/entities/Candidato.php';
    require_once 'assets/entities/Partido.php';
    require_once 'assets/entities/Puesto.php';
    require_once 'assets/entities/Voto.php';
    require_once 'assets/services/VotosService.php';
    require_once 'assets/services/UserService.php';
    require_once 'assets/services/CandidatosService.php';
    require_once 'assets/services/PartidoService.php';
    require_once 'assets/services/PuestosService.php';
    require_once 'assets/helpers/utilities.php';

    session_start();
    
    $directory = "assets/database";

    $serviceAccount = new UserService($directory);
    $servicePartido = new PartidoService($directory);
    $servicePuesto = new PuestosService($directory);
    $serviceCandidatos = new CandidatosService($directory);
    $serviceVoto = new VotosService($directory);

    $listPartido = $servicePartido->GetEstado();
    $listPuesto = $servicePuesto->GetEstado();
    $listCandidato = $serviceCandidatos->GetEstado();

    if(isset($_SESSION['user']) && $_SESSION['user'] != null){
        $user = json_decode($_SESSION['user']);

        if($user->estado == "inactivo")
        {
          header("Location: login/login.php");
          exit();
        }
    }else{
        header("Location: login/login.php");
        exit();
    }

    if(isset($_POST['Presidente']) && isset($_POST['Alcalde']) && isset($_POST['Senador']) && isset($_POST['Diputado'])){
      $newAccount = new Voto();

      $newAccount->initializeData(0, $_POST['Presidente'], $_POST['Alcalde'], $_POST['Senador'], $_POST['Diputado']);

      $serviceVoto->Add($newAccount);

      $serviceAccount->UpdateEstado($user->cedula, "inactivo");

      header("Location: indexVoto.php");
      exit();            
}
    

?>




<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Dashboard Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

    <link rel="stylesheet" href="css/styles.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <body fiprocessed="true">
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="index.php">Elecciones</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="login/logout.php">Salir</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li>
                
                <?php if(!empty($user)): ?>

                    <p>Bienvenido <?php echo $user->nombre . " " . $user->apellido ?></p>
                  <?php endif; ?>
            
            </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" style="margin-bottom: 2%;">

        <form action="index.php" method="POST">
        <?php foreach($listPuesto as $puestos): ?>

          <div class="card">
                  <div class="card-header">
                      <h1><?php echo $puestos->nombre ?></h2>
                  </div>
                  <div class="card-body">
                    <?php if(count($listPartido)>=2): ?>
                    <?php foreach($listPartido as $partidos): ?>
                      <div class="card">
                          <div class="card-header">
                              <h2><?php echo $partidos->logo ?></h1>
                              <h3><?php echo $partidos->nombre ?></h2>
                          </div>
                          <div class="card-body">

                          <div class="container">
                            
                            <div class="row">
                              
                            <?php foreach($listCandidato as $candidatos): ?>
                              <?php if($candidatos->partido == $partidos->nombre && $candidatos->puesto == $puestos->nombre): ?>
                                <div class="col-md-4 col-lg-4 col-sm-4">
                                  <label>
                                    <input type="radio"  name="<?php echo $candidatos->puesto ?>" id="<?php echo $candidatos->puesto ?>" value="<?php echo $partidos->logo . ' ' . $candidatos->nombre . ' ' . $candidatos->apellido ?>" class="card-input-element" />

                                      <div class="panel panel-default card-input">
                                        <img src="assets/candidatos/<?php echo $candidatos->id . ".png"?>" alt="" style="margin-bottom: 2%; margin-top: 2%;">
                                        <div class="panel-heading"><?php echo $candidatos->nombre . " " . $candidatos->apellido ?></div>
                                      </div>

                                  </label>
                                </div>
                              <?php endif;?>
                            <?php endforeach;?> 


                            </div>
                            
                          </div>

                          </div>

                    <?php endforeach;?>
                    <?php else:?>
                      <p>No Hay suficientes partidos para esta posicion</p>
                    <?php endif;?>
                  </div>
                </div>

                    </div>

            
        <?php endforeach;?>
            <button class="btn btn-primary" type="submit">Enviar Voto</button>
        </form>
    </main>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script>

</body></html>