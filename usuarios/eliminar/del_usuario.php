<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    exit('Acceso Denegado');
}
include('../../config/Conexion.php');
$con = new Conexion();
$cmd = $con->PDO();
$res['status'] = 'Error';
$id = isset($_POST['id']) ? $_POST['id'] : exit('Acción no permitida');

try {
    $sql = "DELETE FROM `seg_usuarios`  WHERE `id_user` = ?";
    $sql = $cmd->prepare($sql);
    $sql->bindParam(1, $id, PDO::PARAM_INT);
    $sql->execute();
    if ($sql->rowCount() > 0) {
        $res['status'] = 'ok';
    } else {
        $res['msg'] = $sql->errorInfo()[2];
    }
    $cmd = null;
} catch (PDOException $e) {
    $res['msg'] = $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getMessage();
}
echo json_encode($res);
