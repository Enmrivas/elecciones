<?php
require_once '../helpers/utilities.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once '../entities/Partido.php';
require_once '../services/PartidoService.php';
require_once '../database/DatabaseContext.php';

$service = new PartidoService('../database');

$containsID = isset($_GET['id']);

if($containsID)
{
    $idUser = $_GET['id'];

    $service->Delete($idUser);
}

header("Location: partidos.php");
exit();


?>