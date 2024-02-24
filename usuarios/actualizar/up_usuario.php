<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    exit('Acceso Denegado');
}
$id_user = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : exit('Acceso denegado');
include('../../config/Conexion.php');
include('../../config/autoload.php');
$con = new Conexion();
$cmd = $con->PDO();
$date = new DateTime('now', new DateTimeZone('America/Bogota'));
$fecha = $date->format('Y-m-d H:i:s');
$response['status'] = 'Error';
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
    'fecha'       =>  $fecha,
    'usuario'      =>  $_SESSION['id_user'],
    'id_tercero'    =>  $_POST['id_tercero']
];

$tercero = new Tercero($datos);
$res = $tercero->Modificar();
$res = json_decode($res, true);
if ($res['status'] == 'ok') {
    $cambio = $res['message'];
    $datos = [
        'user'         =>  $_POST['txt_user'],
        'clave'        =>  $_POST['txt_pass'],
        'id_rol'       =>  $_POST['slc_rol'],
        'fecha'      =>  $fecha,
        'usuario'     => $_SESSION['id_user'],
        'id_usuario'   => $id_user,
    ];
    $usuario = new Usuario($datos);
    $res = $usuario->Modificar();
    $res = json_decode($res, true);
    if ($res['status'] == 'ok') {
        if ($cambio == '1' || $res['message'] == '1') {
            $response['status'] = 'ok';
            $response['msg'] = 'Usuario modificado correctamente';
        } else {
            $response['msg'] = 'No se realizo ningún cambio nuevo';
        }
    } else {
        $response['msg'] = $res['message'];
    }
} else {
    $response['msg'] = $res['message'];
}
echo json_encode($response);
