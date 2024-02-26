<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    exit('Acceso Denegado');
}
include('../../config/Conexion.php');
$con = new Conexion();
$cmd = $con->PDO();
$data = [];
try {
    $sql = "SELECT
                `tb_categorias`.`id_categoria`
                , `tb_categorias`.`nombre`
                , `tb_categorias`.`descripcion`
                , `tb_categorias`.`estado`
             
            FROM
                `tb_categorias` ";
    $sql = $cmd->prepare($sql);
    $sql->bindParam(1, $categorias);
    $sql->execute();
    $resultado = $sql->fetchAll();
    foreach ($resultado as $res) {
        $id =  $res['id_categoria'];
        $nombre = $res['nombre'] ;
        $descripcion = $res['descripcion'] ;
        $editar = '<button type="button" class="btn btn-sm btn-outline-info btn-floating shadow-4" data-mdb-ripple-color="info" title="Editar" onclick="EditaCategory(' . $id . ')">
        <i class="fas fa-edit fa-lg"></i></button>';
        $borrar = '<button type="button" class="btn btn-sm btn-outline-danger btn-floating shadow-4" data-mdb-ripple-color="danger" title="Eliminar" onclick="EliminaCategory(' . $id . ')">
        <i class="fas fa-trash-alt fa-lg"></i></button>';
               
        $data[] = [
            $id,
            $nombre,
            $descripcion,
            '<div class="text-center">' . $editar . ' ' . $borrar . '</div>'
        ];
    }
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getMessage();
}
$datos = ['data' => $data];
echo json_encode($datos);
