<?php
session_start();
include '../../config/Conexion.php';
$con = new Conexion();
if (!isset($_SESSION['id_user'])) {
    header('Location: ' . $con->urlin . '/index.php');
    exit;
}
require '../../config/autoload.php';
$con = new Conexion();
$cmd = $con->PDO();
$data = [];
/* try {
    $sql = "SELECT
                `id_tdoc`, `descripcion`
            FROM
                `tb_tipo_documentos`";
    $sql = $cmd->prepare($sql);
    $sql->execute();
    $documentos = $sql->fetchAll();
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getMessage();
} */
/* try {
    $sql = "SELECT
                `id_dpto`
                , `nombre`
            FROM
                `tb_departamentos`";
    $sql = $cmd->prepare($sql);
    $sql->execute();
    $departamentos = $sql->fetchAll();
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getMessage();
} */
?>
<div>
    <form id="formDatacategory">
        
        <div class="row">
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="nombre" name="nombre" class="form-control border" />
                    <label class="form-label" for="nombre">Nombre</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="descripcion" name="descripcion" class="form-control border" />
                    <label class="form-label" for="descripcion">Descripcion</label>
                </div>
            </div>
        </div>
   
    </form>
    <div class="my-4 text-center">
        <button class="btn btn-success" onclick="save_category(1)"></i>Registrar</button>
    </div>
</div>