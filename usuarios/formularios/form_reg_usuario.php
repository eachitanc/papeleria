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
?>
<div>
    <form id="formDataUser">
        <div class="row">
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <div class="form-outline position-relative" data-mdb-input-init>
                        <select class="form-control border" id="slcTipoDoc" name="slcTipoDoc" aria-label="Default">
                            <option value="0" class="text-muted" selected>--Seleccionar--</option>
                            <?php
                            foreach ($documentos as $doc) {
                                echo '<option value="' . $doc['id_tdoc'] . '">' . $doc['descripcion'] . '</option>';
                            }
                            ?>
                        </select>
                        <label class="form-label position-absolute start-0 translate-middle-y" style="font-size: 90% !important; top: -4px; padding-left: 9px;" for="slcTipoDoc">Tipo Documento</label>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="number" id="numDoc" name="numDoc" class="form-control border" data-mdb-input-init>
                    <label class="form-label" for="numDoc">Número Documento</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="txt_user" name="txt_user" class="form-control border" />
                    <label class="form-label" for="txt_user">Usuario</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="password" id="txt_pass" name="txt_pass" class="form-control border" />
                    <label class="form-label" for="txt_pass">Constraseña</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="txt_nombre1" name="txt_nombre1" class="form-control border" />
                    <label class="form-label" for="txt_nombre1">Primer Nombre</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="txt_nombre2" name="txt_nombre2" class="form-control border" />
                    <label class="form-label" for="txt_nombre2">Segundo Nombre</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="txt_apellido1" name="txt_apellido1" class="form-control border" />
                    <label class="form-label" for="txt_apellido1">Primer Apellido</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="txt_apellido2" name="txt_apellido2" class="form-control border" />
                    <label class="form-label" for="txt_apellido2">Segundo Apellido</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <div class="form-outline position-relative" data-mdb-input-init>
                        <select class="form-control border" id="slcDepartamento" name="slcDepartamento" aria-label="Default" onchange="PutMunicipio(this)">
                            <option value="0" class="text-muted" selected>--Seleccionar--</option>
                            <?php
                            foreach ($departamentos as $dpto) {
                                echo '<option value="' . $dpto['id_dpto'] . '">' . $dpto['nombre'] . '</option>';
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
                        <select class="form-control border" id="slcMunicipio" name="slcMunicipio" aria-label="Default">
                            <option value="0" class="text-muted" selected>--Seleccionar--</option>
                        </select>
                        <label class="form-label position-absolute start-0 translate-middle-y" style="font-size: 90% !important; top: -4px; padding-left: 9px;" for="slcMunicipio">Municipio</label>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="txt_direccion" name="txt_direccion" class="form-control border" />
                    <label class="form-label" for="txt_direccion">Dirección</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <input type="text" id="txt_telefono" name="txt_telefono" class="form-control border" />
                    <label class="form-label" for="txt_telefono">Teléfono</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-outline my-3">
                    <input type="email" id="txt_correo" name="txt_correo" class="form-control border" />
                    <label class="form-label" for="txt_correo">Correo</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline my-3">
                    <div class="form-outline position-relative" data-mdb-input-init>
                        <select class="form-control border" id="slc_rol" name="slc_rol" aria-label="Default">
                            <option value="0" class="text-muted" selected>--Seleccionar--</option>
                            <option value="1" >ADMINISTRADOR</option>
                            <option value="2" >INVITADO</option>
                        </select>
                        <label class="form-label position-absolute start-0 translate-middle-y" style="font-size: 90% !important; top: -4px; padding-left: 9px;" for="slc_rol">Rol</label>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="my-4 text-center">
        <button class="btn btn-success" onclick="UserSistema()"></i>Registrar</button>
    </div>
</div>