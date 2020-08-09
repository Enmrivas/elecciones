<?php 
    require_once 'assets/helpers/FileHandler/JsonFileHandler.php';
    require_once 'assets/helpers/FileHandler/IFileHandler.php';
    require_once 'assets/database/DatabaseContext.php';
    require_once 'assets/entities/User.php';
    require_once 'assets/helpers/utilities.php';
    require_once 'assets/services/UserService.php';

    session_start();
    
    $serviceAccount = new UserService("assets/database");

    if(isset($_SESSION['admin']) && $_SESSION['admin'] != null){
        $user = json_decode($_SESSION['admin']);
    }else{
        header("Location: login/loginAdmin.php");
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/styles.css" rel="stylesheet">
  <body fiprocessed="true">
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="index.php">Admin</a>
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
        <div class="container" style="margin-top: 4%;">
            <div class="row">
                  <div class="col-sm-3">
                      <a href="assets/ciudadanos/ciudadanos.php" class="btn btn-primary" style="width: 200px; height: 200px;">Ciudadanos</a>
                      <a href="assets/partidos/partidos.php" class="btn btn-primary" style="width: 200px; height: 200px; margin-top: 10%;">Partidos</a>
                  </div>
                  <div class="col-sm-3">
                      <a href="assets/admin/admin.php" class="btn btn-primary" style="width: 200px; height: 200px;">Usuarios Admin</a>
                  </div>
                  <div class="col-sm-3">
                      <a href="assets/candidatos/candidatos.php" class="btn btn-primary" style="width: 200px; height: 200px;">Candidatos</a>
                      <a href="assets/puestos/puestos.php" class="btn btn-primary" style="width: 200px; height: 200px; margin-top: 10%;">Puestos Electivos</a>
                  </div>
            </div>
        </div>
    </main>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script>

</body></html>