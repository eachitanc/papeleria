<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    exit('Acceso Denegado');
}
include('../../config/Conexion.php');
$con = new Conexion();
$cmd = $con->PDO();
$res['status'] = 'Error';
$res['msg'] = $_POST['id'];
echo json_encode($res);
