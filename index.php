<?php
session_start();
include 'config/conexion.php';
$con = new conexion();

session_destroy();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Papeleria V1.0</title>
    <link rel="icon" href="<?php echo $con->urlin ?>/img/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="<?php echo $con->urlin ?>/css/mdb.min.css" />
</head>

<body class="bg-cronhis">
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="card" style="width: 20rem;">
            <div class="card p-2">
                <img src="img/logoFinanciero.png" class="card-img-top" alt="Logo">
            </div>
            <div class="card-body">
                <form id="formLogin">
                    <div class="form-outline my-3">
                        <input type="text" id="txtUser" name="txtUser" class="form-control" />
                        <label class="form-label" for="txtUser">Usuario</label>
                    </div>
                    <div class="form-outline my-3 d-flex align-items-center">
                        <input type="password" id="txtPass" name="txtPass" class="form-control" />
                        <label class="form-label" for="txtPass">Contraseña</label>
                        <div id="mayAct" class="invalid-tooltip" style="background-color: #F0B27A !important;">Mayúsculas activas</div>
                        <button type="button" class="btn btn-ligth ml-2 px-2" id="toglePass"><i class="fas fa-eye fa-xl link-danger"></i></button>
                    </div>
                    <div class="my-3">
                        <select class="form-select" aria-label="Seleccionar opción" id="slcVigencia" name="slcVigencia" style="font-size: 15px;">
                            <option value="0" disabled selected class="text-muted">--Seleccionar--</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                    </div>
                </form>
                <div class="text-center mt-4">
                    <button class="btn btn-success" onclick="LoginAuth()"><i class="fa-solid fa-unlock"></i> Iniciar Sesión</button>
                </div>
            </div>
            <div class="card-footer text-center">
                <div class="small">Bienvenid@</div>
            </div>
        </div>
    </div>
    <!-- modal-->
    <div class="modal fade" id="modalDone" tabindex="-1" aria-labelledby="modalDoneLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-light bg-success">
                    <h5 class="modal-title" id="modalDoneLabel">
                        <span class="fa-solid fa-circle-check fa-lg"></span> Éxito
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-mdb-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-center" id="modalDoneMsg"></div>
                <div class="modal-footer p-1" id="modalDoneFooter">
                    <button type="button" class="btn btn-sm btn-secondary" data-mdb-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalError" tabindex="-1" aria-labelledby="modalErrorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-light bg-danger">
                    <h5 class="modal-title" id="modalErrorLabel">
                        <span class="fa-solid fa-circle-xmark fa-lg"></span> Error
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-mdb-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-center" id="modalErrorMsg"></div>
                <div class="modal-footer p-1" id="modalErrorFooter">
                    <button type="button" class="btn btn-sm btn-secondary" data-mdb-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalAlert" tabindex="-1" aria-labelledby="modalAlertLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-light bg-warning">
                    <h5 class="modal-title" id="modalAlertLabel">
                        <span class="fa-solid fa-triangle-exclamation fa-lg"></span> Error
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-mdb-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body text-center" id="modalAlertMsg"></div>
                <div class="modal-footer p-1" id="modalAlertFooter">
                    <button type="button" class="btn btn-sm btn-secondary" data-mdb-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal-->
    <script type="text/javascript" src="<?php echo $con->urlin ?>/js/mdb.min.js"></script>
    <script type="text/javascript" src="<?php echo $con->urlin ?>/js/login.js?v=<?php echo date('YmdHis') ?>"></script>
    <script type="text/javascript" src="<?php echo $con->urlin ?>/js/sha.js?v=<?php echo date('YmdHis') ?>"></script>
    <script type="text/javascript" src="<?php echo $con->urlin ?>/comunes/js/funciones.js?v=<?php echo date('YmdHis') ?>"></script>
</body>

</html>