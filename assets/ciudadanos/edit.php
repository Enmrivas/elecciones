<?php 
    require_once '../helpers/FileHandler/JsonFileHandler.php';
    require_once '../helpers/FileHandler/IFileHandler.php';
    require_once '../database/DatabaseContext.php';
    require_once '../entities/User.php';
    require_once '../helpers/utilities.php';
    require_once '../services/UserService.php';

    session_start();
    
    $service = new UserService("../database");
    $utilities = new Utilities();

    if(isset($_GET['cedula']))
    {
        $cedula = $_GET['cedula'];
        $user = $service->GetByCedula($cedula);

        if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['estado'])){

            $newUpdate = new Users();

            $newUpdate->initializeData($cedula, $_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['estado']);

            $service->Update($cedula, $newUpdate);

            header("Location: ciudadanos.php");
            exit();
        } 
    }

            


?>

<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Elecciones</title>

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
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="../index.php">Blog</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
            <a class="nav-link" href="ciudadanos.php">Atras</a>
            </li>
        </ul>
    </nav>

<main role="main" style="background: grey; padding: 5%; margin-top: 3%;">

    <div class="container">

        <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form action="edit.php?cedula=<?php echo $user->cedula ?>" method="POST">
                    <div class="form-group">
                        <label for="cedula">Cedula: </label>
                        <?php echo $user->cedula ?>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input required value="<?php echo $user->nombre ?>" type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input required value="<?php echo $user->apellido ?>" type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                    </div>
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input required value="<?php echo $user->email ?>" type="email" class="form-control" id="email" name="email" placeholder="Correo Electronico">
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