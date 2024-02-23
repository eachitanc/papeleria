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
                `seg_usuarios`.`id_user`
                , `seg_usuarios`.`user`
                , `seg_usuarios`.`estado`
                , `seg_rol_user`.`descripcion`
                , `seg_terceros`.`no_doc`
                , `seg_terceros`.`nombre1`
                , `seg_terceros`.`nombre2`
                , `seg_terceros`.`apellido1`
                , `seg_terceros`.`apellido2`
                , `seg_terceros`.`razon social`
                , `seg_terceros`.`correo`
            FROM
                `seg_usuarios`
                INNER JOIN `seg_rol_user` 
                    ON (`seg_usuarios`.`id_rol` = `seg_rol_user`.`id_rol`)
                INNER JOIN `seg_terceros` 
                    ON (`seg_usuarios`.`id_tercero` = `seg_terceros`.`id_tercero`)";
    $sql = $cmd->prepare($sql);
    $sql->bindParam(1, $usuario);
    $sql->execute();
    $resultado = $sql->fetchAll();
    foreach ($resultado as $res) {
        $id =  $res['id_user'];
        $nombre = $res['nombre1'] . ' ' . $res['nombre2'] . ' ' . $res['apellido1'] . ' ' . $res['apellido2'];
        $editar = '<button type="button" class="btn btn-sm btn-outline-info btn-floating shadow-4" data-mdb-ripple-color="info" title="Editar"><i class="fas fa-edit fa-lg"></i></button>';
        $borrar = '<button type="button" class="btn btn-sm btn-outline-danger btn-floating shadow-4" data-mdb-ripple-color="danger" title="Eliminar"><i class="fas fa-trash-alt fa-lg"></i></button>';
        $status = $res['estado'] == 1 ? 'fa-toggle-on' : 'fa-toggle-off';
        $color = $res['estado'] == 1 ? 'success' : 'secondary';
        $estado = '<a href="javascript:void(0)" role="button" class="link-' . $color . '" title="Cambiar Estado" onclick="ToggleStatus(' . $id . ')"><i class="fas ' . $status . ' fa-2x"></i></a>';
        $data[] = [
            $id,
            $res['user'],
            $nombre,
            '<div class="text-center">' . $estado . '</div>',
            '<div class="text-center">' . $editar . ' ' . $borrar . '</div>',
        ];
    }
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getMessage();
}
$datos = ['data' => $data];
echo json_encode($datos);
