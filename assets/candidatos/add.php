<?php 
    require_once '../helpers/FileHandler/JsonFileHandler.php';
    require_once '../helpers/FileHandler/IFileHandler.php';
    require_once '../database/DatabaseContext.php';
    require_once '../entities/Candidato.php';
    require_once '../entities/Puesto.php';
    require_once '../entities/Partido.php';
    require_once '../helpers/utilities.php';
    require_once '../services/CandidatosService.php';
    require_once '../services/PartidoService.php';
    require_once '../services/PuestosService.php';

    session_start();
    
    $service = new CandidatosService("../database");
    $utilities = new Utilities();
    $message = "";

    $partido = new PartidoService('../database');
    $puesto = new PuestosService('../database');

    $partidoList = $partido->GetList();
    $puestoList = $puesto->GetList();

    if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['partido']) && isset($_POST['puesto']) && isset($_POST['estado']) && isset($_FILES['fotoPerfil'])){
            $newAccount = new Candidato();

            $newAccount->initializeData(0, $_POST['nombre'], $_POST['apellido'], $_POST['partido'], $_POST['puesto'], $_POST['estado']);

            $service->Add($newAccount);

            $message = "";
            header("Location: candidatos.php");
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
            <div class="card-header">Registrar Candidato</div>
            <div class="card-body">
                <?php if($message != ""): ?>
                    <div class="alert alert-danger" role="alet">
                        <?= $message; ?>
                    </div>
                <?php endif; ?>
                <form enctype="multipart/form-data" action="add.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input required type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input required type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                    </div>
                    <div class="form-group">
                        <label for="partido">Partido</label>
                        <select name="partido" id="partido" class="form-control">
                            <option selected>Elija un partido</option>
                            <?php foreach($partidoList as $partidos): ?>
                                <option value="<?php echo $partidos->nombre ?>"><?php echo $partidos->nombre ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="puesto">Puesto</label>
                        <select name="puesto" id="puesto" class="form-control">
                            <option selected>Elija un puesto</option>
                            <?php foreach($puestoList as $puestos): ?>
                                <option value="<?php echo $puestos->nombre ?>"><?php echo $puestos->nombre ?></option>
                            <?php endforeach; ?>
                        </select>
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
                    <div class="form-group">
                        <label for="foto">Foto de Perfil</label>
                        <input type="file" class="form-control" id="foto" name="fotoPerfil" placeholder="Foto de Perfil">
                    </div>
                    <button class="btn btn-primary" style="float: right; margin-top: 2%;" type="submit">Enviar</button>
                </form>
            </div>
        </div>
        
    </div>

</main>
    </body>
    </html>