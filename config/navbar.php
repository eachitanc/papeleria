<nav class="navbar navbar-light bg-cronhis mt-1 rounded-1">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler pt-2" type="button" data-mdb-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation" style="color:#f1f1f1">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Right elements -->
        <div class="d-flex align-items-center">

        </div>
        <div class="opcionesUser">
            <div class="dropdown">
                <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                    <div class="profile bg-light rounded-circle">
                        <img src="<?php echo $con->urlin  ?>/img/profile.png" alt="Foto de perfil" class="img-fluid">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                    <li>
                        <a class="dropdown-item link-success" href="#"><i class="fa-solid fa-address-card fa-lg me-3"></i> Mi perfíl</a>
                    </li>
                    <li>
                        <a class="dropdown-item link-primary" href="#"><i class="fa-solid fa-gears fa-lg me-3"></i> Configuración</a>
                    </li>
                    <li>
                        <a class="dropdown-item link-secondary" href="#"><i class="fa-solid fa-right-from-bracket fa-lg me-3"></i> Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>