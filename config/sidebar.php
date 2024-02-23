<?php
include_once 'Conexion.php';
$con = new Conexion();
?>
<div id="sidebar" class="mt-1 mx-1 rounded-6 bg-light active">
    <a href="<?php echo $con->urlin  ?>/inicio/panel_control.php" class="card-link">
        <div class="card ripple rounded-0 p-2" style="border-radius: 0.5rem 0.5rem 0rem 0rem !important;">
            <img src="<?php echo $con->urlin  ?>/img/logo.png" class="card-img-top" alt="logo_empresa">
        </div>
    </a>
    <div class="border"></div>
    <div class="list-group list-group-flush">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="javascript:void(0)" class="d-flex align-items-center ripple link-info">
                    <i class="fas fa-home fa-lg me-3"></i>
                    <span>INICIO</span>
                </a>
            </li>
            <li class="list-group-item submenu enfocar">
                <a href="javascript:void(0)" class="d-flex align-items-center link-success" data-mdb-toggle="collapse" data-mdb-target="#submenu1" onclick="toggleArrow(this)">
                    <i class="fa-solid fa-address-book fa-lg me-3"></i>
                    <span>PAPELERÍA</span>
                    <i class="fas fa-caret-right ms-auto arrowIcon"></i>
                </a>
                <div class="collapse shadow w-100" id="submenu1">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item enfocar">
                            <a href="javascript:void(0)" class="d-flex align-items-center ripple">
                                <i class="fas fa-users me-3 text-warning"></i>
                                <span>Empleados</span>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="javascript:void(0)" class="d-flex align-items-center ripple">
                                <i class="fas fa-users me-3"></i>
                                <span>Subopción 2</span>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="javascript:void(0)" class="d-flex align-items-center ripple">
                                <i class="fas fa-chart-bar me-3"></i>
                                <span>Subopción 3</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php if (false) { ?>
                <li class="list-group-item submenu">
                    <a href="javascript:void(0)" class="d-flex align-items-center" data-mdb-toggle="collapse" data-mdb-target="#submenu2" onclick="toggleArrow(this)">
                        <i class="fas fa-envelope me-3"></i>
                        <span>Opción 3</span>
                        <i class="fas fa-caret-right ms-auto arrowIcon"></i>
                    </a>
                    <div class="collapse" id="submenu2">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="javascript:void(0)" class="d-flex align-items-center ripple">
                                    <i class="fas fa-inbox me-3"></i>
                                    <span>Subopción 4</span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="javascript:void(0)" class="d-flex align-items-center ripple">
                                    <i class="fas fa-paper-plane me-3"></i>
                                    <span>Subopción 5</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="list-group-item">
                    <a href="javascript:void(0)" class="d-flex align-items-center ripple">
                        <i class="fas fa-bell me-3"></i>
                        <span>Opción 4</span>
                    </a>
                </li>
            <?php }
            if ($_SESSION['rol'] == 1) { ?>
                <li class="list-group-item enfocar">
                    <a href="../usuarios/gestion.php" class="d-flex align-items-center link-danger">
                        <i class="fas fa-user-lock me-3"></i>
                        <span>USUARIOS</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>