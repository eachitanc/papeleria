<?php
session_start();
include '../../config/Conexion.php';
$con = new Conexion();
if (!isset($_SESSION['id_user'])) {
    header('Location: ' . $con->urlin . '/index.php');
    exit;
}
$id = $_POST['id'];
require '../../config/autoload.php';
$con = new Conexion();
$cmd = $con->PDO();
$data = [];
try {
    $sql = "SELECT
                `id_municipio`
                , `municipio`
            FROM
                `tb_municipios`
            WHERE (`id_dpto` = $id) 
            ORDER BY `municipio` ASC";
    $sql = $cmd->prepare($sql);
    $sql->execute();
    $municipios = $sql->fetchAll();
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getMessage();
}
$res = '<option value ="0" class="text-muted">--Seleccione--</option>';
foreach ($municipios as $mun) {
    $res .= '<option value="' . $mun['id_municipio'] . '">' . $mun['municipio'] . '</option>';
}
echo $res;
