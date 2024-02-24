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
$id_user = $_POST['id'];
try {
    $sql = "SELECT
                `seg_usuarios`.`id_user`
                , `seg_usuarios`.`id_tercero`
                , `seg_usuarios`.`user`
                , `seg_usuarios`.`clave`
                , `seg_usuarios`.`id_rol`
                , `seg_usuarios`.`estado`
                , `seg_terceros`.`id_tdoc`
                , `seg_terceros`.`no_doc`
                , `seg_terceros`.`nombre1`
                , `seg_terceros`.`nombre2`
                , `seg_terceros`.`apellido1`
                , `seg_terceros`.`apellido2`
                , `seg_terceros`.`id_dpto`
                , `seg_terceros`.`id_municipio`
                , `seg_terceros`.`direccion`
                , `seg_terceros`.`correo`
                , `seg_terceros`.`telefono`
            FROM
                `seg_usuarios`
                INNER JOIN `seg_terceros` 
                    ON (`seg_usuarios`.`id_tercero` = `seg_terceros`.`id_tercero`)
            WHERE (`seg_usuarios`.`id_user` = $id_user)";
    $sql = $cmd->prepare($sql);
    $sql->execute();
    $usuario = $sql->fetch();
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getMessage();
}
try {
    $sql = "SELECT
                `id_tdoc`, `descripcion`
            FROM
                `tb_tipo_documentos`";
    $sql = $cmd->prepare($sql);
    $sql->execute();
    $documentos = $sql->fetchAll();
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getMessage();
}
try {
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
}
$id_dpto = $usuario['id_dpto'];
try {
    $sql = "SELECT
                `id_municipio`
                , `municipio`
            FROM
                `tb_municipios`
            WHERE (`id_dpto` = $id_dpto)";
    $sql = $cmd->prepare($sql);
    $sql->execute();
    $municipios = $sql->fetchAll();
} catch (PDOException $e) {
    echo $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getMessage();
}
?>
<div>
    <form id="formDataUser">
        <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $id_user ?>">
        <input type="hidden" name="id_tercero" id="id_tercero" value="<?php echo $usuario['id_tercero'] ?>">
        <div class="row">
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <div class="form-outline position-relative" data-mdb-input-init>
                        <select class="form-control border active" id="slcTipoDoc" name="slcTipoDoc" aria-label="Default">
                            <?php
                            foreach ($documentos as $doc) {
                                $slc = $doc['id_tdoc'] == $usuario['id_tdoc'] ? 'selected' : '';
                                echo '<option ' . $slc . ' value="' . $doc['id_tdoc'] . '">' . $doc['descripcion'] . '</option>';
                            }
                            ?>
                        </select>
                        <label class="form-label position-absolute start-0 translate-middle-y" style="font-size: 90% !important; top: -4px; padding-left: 9px;" for="slcTipoDoc">Tipo Documento</label>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="number" id="numDoc" name="numDoc" class="form-control border active" value="<?php echo $usuario['no_doc'] ?>" data-mdb-input-init>
                    <label class="form-label" for="numDoc">Número Documento</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="txt_user" name="txt_user" class="form-control border active" value="<?php echo $usuario['user'] ?>" data-mdb-input-init>
                    <label class="form-label" for="txt_user">Usuario</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="password" id="txt_pass" name="txt_pass" class="form-control border active" value="<?php echo $usuario['clave'] ?>" data-mdb-input-init>
                    <label class="form-label" for="txt_pass">Constraseña</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="txt_nombre1" name="txt_nombre1" class="form-control border active" value="<?php echo $usuario['nombre1'] ?>" data-mdb-input-init>
                    <label class="form-label" for="txt_nombre1">Primer Nombre</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="txt_nombre2" name="txt_nombre2" class="form-control border active" value="<?php echo $usuario['nombre2'] ?>" data-mdb-input-init>
                    <label class="form-label" for="txt_nombre2">Segundo Nombre</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="txt_apellido1" name="txt_apellido1" class="form-control border active" value="<?php echo $usuario['apellido1'] ?>" data-mdb-input-init>
                    <label class="form-label" for="txt_apellido1">Primer Apellido</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="txt_apellido2" name="txt_apellido2" class="form-control border active" value="<?php echo $usuario['apellido2'] ?>" data-mdb-input-init>
                    <label class="form-label" for="txt_apellido2">Segundo Apellido</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <div class="form-outline position-relative" data-mdb-input-init>
                        <select class="form-control border active" id="slcDepartamento" name="slcDepartamento" aria-label="Default" onchange="PutMunicipio(this)">
                            <?php
                            foreach ($departamentos as $dpto) {
                                $slc = ($dpto['id_dpto'] == $id_dpto) ? 'selected' : '';
                                echo '<option ' . $slc . ' value="' . $dpto['id_dpto'] . '">' . $dpto['nombre'] . '</option>';
                            }
                            ?>
                        </select>
                        <label class="form-label position-absolute start-0 translate-middle-y" style="font-size: 90% !important; top: -4px; padding-left: 9px;" for="slcDepartamento">Departamento</label>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <div class="form-outline position-relative" data-mdb-input-init>
                        <select class="form-control border active" id="slcMunicipio" name="slcMunicipio" aria-label="Default">
                            <?php
                            foreach ($municipios as $mun) {
                                $slc = ($mun['id_municipio'] == $usuario['id_municipio']) ? 'selected' : '';
                                echo '<option ' . $slc . ' value="' . $mun['id_municipio'] . '">' . $mun['municipio'] . '</option>';
                            }
                            ?>
                        </select>
                        <label class="form-label position-absolute start-0 translate-middle-y" style="font-size: 90% !important; top: -4px; padding-left: 9px;" for="slcMunicipio">Municipio</label>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="txt_direccion" name="txt_direccion" class="form-control border active" value="<?php echo $usuario['direccion'] ?>" data-mdb-input-init>
                    <label class="form-label" for="txt_direccion">Dirección</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="txt_telefono" name="txt_telefono" class="form-control border active" value="<?php echo $usuario['telefono'] ?>" data-mdb-input-init>
                    <label class="form-label" for="txt_telefono">Teléfono</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-outline my-3">
                    <input type="email" id="txt_correo" name="txt_correo" class="form-control border active" value="<?php echo $usuario['correo'] ?>" data-mdb-input-init>
                    <label class="form-label" for="txt_correo">Correo</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <div class="form-outline position-relative" data-mdb-input-init>
                        <select class="form-control border active" id="slc_rol" name="slc_rol" aria-label="Default">
                            <option value="1" <?php echo $usuario['id_rol'] == 1 ? 'selected' : ''; ?>>ADMINISTRADOR</option>
                            <option value="2" <?php echo $usuario['id_rol'] == 2 ? 'selected' : ''; ?>>INVITADO</option>
                        </select>
                        <label class="form-label position-absolute start-0 translate-middle-y" style="font-size: 90% !important; top: -4px; padding-left: 9px;" for="slc_rol">Rol</label>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="my-4 text-center">
        <button class="btn btn-success" onclick="UserSistema(2)"></i>Actualizar</button>
    </div>
</div>