<?php 
    require_once '../assets/database/DatabaseContext.php';
    require_once '../assets/entities/User.php';
    require_once '../assets/helpers/FileHandler/IFileHandler.php';
    require_once '../assets/helpers/FileHandler/JsonFileHandler.php';
    require_once '../assets/services/UserService.php';

    $result = null;
    $message = "";

    session_start();

    $service = new UserService("../assets/database");

    if(isset($_POST['cedula']))
    {
        $result = $service->Login($_POST['cedula']);

        if($result != null && $result->estado == "activo")
        {
            $_SESSION['user'] = json_encode($result);
            unset($_SESSION['admin']);
            header("Location: ../index.php");
            exit();
        }
        else
        {
            $message = "Cedula es incorrecta o esta inactiva.";
        }
    }

?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="../css/styles.css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Login</title>
</head>
<body>

<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="../index.php">Elecciones</a>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="loginAdmin.php">Admin Login</a>
    </li>
  </ul>
</nav>

<main class="login-form card" style="background: grey; padding: 5%; margin-top: 3%;">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">

                    <?php if($message != ""): ?>
                    <div class="alert alert-danger" role="alet">
                        <?= $message; ?>
                    </div>
                    <?php endif; ?>
                        <form action="login.php" method="POST">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">Cedula</label>
                                <div class="col-md-6">
                                    <input type="number" id="cedula" class="form-control" name="cedula" required autofocus>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                                <a href="register.php" class="btn btn-primary">
                                    Registrarse
                                </a>
                                
                            </div>                        
                        </form>
                        </div>
                </div>
            </div>
        </div>
    </div>

</main>







</body>
</html>