<?php 
    require_once '../helpers/FileHandler/JsonFileHandler.php';
    require_once '../helpers/FileHandler/IFileHandler.php';
    require_once '../database/DatabaseContext.php';
    require_once '../entities/Partido.php';
    require_once '../helpers/utilities.php';
    require_once '../services/PartidoService.php';

    session_start();
    
    $service = new PartidoService("../database");
    $utilities = new Utilities();

    if(isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['logo']) && isset($_POST['estado'])){
            $newAccount = new Partido();

            $newAccount->initializeData(0, $_POST['nombre'], $_POST['descripcion'], $_POST['logo'], $_POST['estado']);

            $service->Add($newAccount);

            

            header("Location: partidos.php");
            exit();            
    }

?>

<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Admin</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    </head>
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
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="../../indexAdmin.php">Admin</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
            <a class="nav-link" href="../../login/loginAdmin.php">Iniciar Sesion</a>
            </li>
        </ul>
    </nav>

<main role="main" style="background: grey; padding: 5%; margin-top: 3%;">

    <div class="container">

        <div class="card">
            <div class="card-header">Registrar Partido</div>
            <div class="card-body">
                <form action="add.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input required type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <textarea class="form-control" aria-label="With textarea" id="descripcion" name="descripcion"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input required type="text" class="form-control" id="logo" name="logo" placeholder="Logo">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label></br>
                        <label>
                        <input checked type="radio" id="estado" name="estado" value="activo"> Activo 
                        </label>
                        <label>
                        <input type="radio" id="estado" name="estado" value="inactivo"> Inactivo 
                        </label>
                    </div>
                    <button class="btn btn-primary" style="float: right; margin-top: 2%;" type="submit">Enviar</button>
                </form>
            </div>
        </div>
        
    </div>

</main>
    </body>
    </html>