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
$id_category = $_POST['id'];
try {
    $sql = "SELECT
                `tb_categorias`.`id_categoria`
                , `tb_categorias`.`nombre`
                , `tb_categorias`.`descripcion`
                , `tb_categorias`.`estado`
             
            FROM
                `tb_categorias`
            WHERE  `tb_categorias`.`id_categoria` = \"{$id_category}\"    ";
    $sql = $cmd->prepare($sql);
    $sql->execute();
    $category = $sql->fetch();
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getMessage();
}

?>

<div>
    <form id="formDataUser">
        <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $category['id'] ?>">
        <div class="row">
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="nombre" name="nombre" class="form-control border active" value="<?php echo $category['nombre'] ?>" />
                    <label class="form-label" for="nombre">Nombre</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="descripcion" name="descripcion" class="form-control border active" value="<?php echo $category['descripcion'] ?>" />
                    <label class="form-label" for="descripcion">Descripcion</label>
                </div>
            </div>
        </div>
       
    </form>
    <div class="my-4 text-center">
        <button class="btn btn-success" onclick="EditaCategory( $category['id'] )"></i>Actualizar</button>
    </div>
</div>