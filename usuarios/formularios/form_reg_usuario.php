<?php
session_start();
include '../../config/Conexion.php';
$con = new Conexion();
if (!isset($_SESSION['id_user'])) {
    header('Location: ' . $con->urlin . '/index.php');
    exit;
}
require '../../config/autoload.php';
