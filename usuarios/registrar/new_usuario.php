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
    'id_tdoc'       =>  $_POST['slcTipoDoc'],
    'no_doc'        =>  $_POST['numDoc'],
    'nombre1'       =>  $_POST['txt_nombre1'],
    'nombre2'       =>  $_POST['txt_nombre2'],
    'apellido1'     =>  $_POST['txt_apellido1'],
    'apellido2'     =>  $_POST['txt_apellido2'],
    'razon social'  =>  '',
    'genero'        =>  '',
    'id_pais'       =>  '1',
    'id_dpto'       =>  $_POST['slcDepartamento'],
    'id_municipio'  =>  $_POST['slcMunicipio'],
    'direccion'     =>  $_POST['txt_direccion'],
    'correo'        =>  $_POST['txt_correo'],
    'telefono'      =>  $_POST['txt_telefono'],
    'fec_reg'       =>  $fecha,
    'user_reg'      =>  $_SESSION['id_user']
];

$tercero = new Tercero($datos);
$res = $tercero->Registrar();
$res = json_decode($res, true);
if ($res['status'] == 'ok') {
    $id_tercero = $res['id'];
    $datos = [
        'user'       =>  $_POST['txt_user'],
        'clave'        =>  $_POST['txt_pass'],
        'id_rol'       =>  $_POST['slc_rol'],
        'estado'       =>  '1',
        'fec_reg'     =>  $fecha,
        'user_reg'     => $_SESSION['id_user'],
        'id_tercero'     => $id_tercero,
    ];
    $usuario = new Usuario($datos);
    $res = $usuario->Registrar();
    $res = json_decode($res, true);
    if ($res['status'] == 'ok') {
        $response['status'] = 'ok';
        $response['msg'] = 'Usuario registrado correctamente';
    } else {
        $response['msg'] = $res['message'];
    }
} else {
    $response['msg'] = $res['message'];
}

echo json_encode($response);
