<?php
require_once '../helpers/utilities.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../entities/userAdmin.php';
require_once '../services/AdminService.php';
require_once '../database/DatabaseContext.php';

$service = new AdminService('../database');

$containsID = isset($_GET['id']);

if($containsID)
{
    $idUser = $_GET['id'];

    $service->Delete($idUser);
}

header("Location: admin.php");
exit();


?>