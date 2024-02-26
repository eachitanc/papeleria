<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    exit('Acceso Denegado');
}
include('../../config/Conexion.php');
include('../../config/autoload.php');
$con = new Conexion();
$cmd = $con->PDO();
$date = new DateTime('now', new DateTimeZone('America/Bogota'));
$response['status'] = 'Error';
$fecha = $date->format('Y-m-d H:i:s');
$datos = [
    'nombre'       =>  $_POST['nombre'],
    'descripcion'  =>  $_POST['descripcion'],
    'estado'       =>  'ACTIVO',
    
];

$Category = new Category($datos);
    $res = $Category->RegistrarCategory();
    $res = json_decode($res, true);
    if ($res['status'] == 'ok') {
        $response['status'] = 'ok';
        $response['msg'] = 'Categoria registrado correctamente';
    } else {
        $response['msg'] = $res['message'];
    }

echo json_encode($response);
