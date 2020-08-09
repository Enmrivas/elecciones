<?php 
    require_once '../assets/helpers/FileHandler/JsonFileHandler.php';
    require_once '../assets/helpers/FileHandler/IFileHandler.php';
    require_once '../assets/database/DatabaseContext.php';
    require_once '../assets/entities/User.php';
    require_once '../assets/helpers/utilities.php';
    require_once '../assets/services/UserService.php';

    session_start();
    
    $service = new UserService("../assets/database");
    $utilities = new Utilities();
    $message = "";
    if(isset($_POST['cedula']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email'])){
            $newAccount = new Users();

            $user = $service->GetByCedula($_POST['cedula']);

            if(empty($user)){
                $admin = "no";
                $estado = "activo";

                $newAccount->initializeData($_POST['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST['email'], $estado, $admin);

                $service->Add($newAccount);

                $message = "";
                header("Location: ../index.php");
                exit();
            }else {
                $message = "Ya esta cedula ha votado";
            }

            
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


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <body fiprocessed="true" onload="hide();">
    <script src="js/script.js"></script>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="../index.php">Blog</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
            <a class="nav-link" href="login.php">Iniciar Sesion</a>
            </li>
        </ul>
    </nav>

<main role="main" style="background: grey; padding: 5%; margin-top: 3%;">

    <div class="container">

        <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
                <?php if($message != ""): ?>
                    <div class="alert alert-danger" role="alet">
                        <?= $message; ?>
                    </div>
                <?php endif; ?>
                <form action="register.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input required type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input required type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                    </div>
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input required type="email" class="form-control" id="email" name="email" placeholder="Correo Electronico">
                    </div>
                    <div class="form-group">
                        <label for="cedula">Cedula</label>
                        <input required type="number" class="form-control" id="cedula" name="cedula" placeholder="Cedula">
                    </div>
                    <button class="btn btn-primary" style="float: right; margin-top: 2%;" type="submit">Enviar</button>
                </form>
            </div>
        </div>
        
    </div>

</main>