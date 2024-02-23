<?php

session_start();
if (!isset($_POST['usuario']) || !isset($_POST['password'])) {
    exit('Acceso Denegado');
}
include '../../config/conexion.php';
$conexion = new Conexion();
$cmd = $conexion->PDO();
$usuario = mb_strtolower($_POST['usuario']);
$password = $_POST['password'];
$res['status'] = 'fail';
try {
    $sql = "SELECT
                `id_user`, `user`, `clave`, `id_rol`, `estado`
            FROM
                `seg_usuarios`
            WHERE `user` = ?";
    $sql = $cmd->prepare($sql);
    $sql->bindParam(1, $usuario);
    $sql->execute();
    $resultado = $sql->fetch();
    if (!empty($resultado)) {
        $pass = $resultado['clave'];
        if (($password === $pass)) {
            if ($resultado['estado'] == 1) {
                $_SESSION['id_user'] = $resultado['id_user'];
                $_SESSION['user'] = $resultado['user'];
                $_SESSION['rol'] = $resultado['id_rol'];
                $_SESSION['vigencia'] = $_POST['vigencia'];
                $_SESSION['sidebar'] = 1;
                $res['status'] = "ok";
            } else {
                $res['msg'] = 'Usuario inactivo';
                $res['input'] = 'txtUser';
            }
        } else {
            $res['msg'] = 'Contraseña incorrecta';
            $res['input'] = 'password';
        }
    } else {
        $res['msg'] = 'Usuario no registrado en el sistema';
        $res['input'] = 'user';
    }
} catch (PDOException $e) {
    $res['msg'] = $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getMessage();
}
echo json_encode($res);
