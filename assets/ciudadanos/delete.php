<?php
require_once '../helpers/utilities.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../entities/User.php';
require_once '../services/UserService.php';
require_once '../database/DatabaseContext.php';

$service = new UserService('../database');

$containsID = isset($_GET['cedula']);

if($containsID)
{
    $idUser = $_GET['cedula'];

    $service->Delete($idUser);
}

header("Location: ciudadanos.php");
exit();


?>