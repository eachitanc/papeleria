<?php
//include("../config/plantilla.php");
?>

<!DOCTYPE html>
<html lang="es">
<?php include '../config/head.php' ?>

<body>
  <div class="color-base">
    <?php include '../config/sidebar.php' ?>
    <div id="content" class="active">
      <?php include '../config/navbar.php' ?>
      <div id="contenido" class="vh-full rounded-1 p-3 bg-light">

        <div class="card">
          <div class="card-header bg-danger link-light">
            <h6 class="mb-0">CATEGORIA</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="tableCategory"
                class="table table-sm table-striped table-hover table-bordered align-middle nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <?php include '../config/footer.php' ?>
    </div>
  </div>

    <?php
    include '../config/modales.php';
    include '../config/script.php';
    ?>
<script type="text/javascript" src="<?php echo $con->urlin ?>/category/js/fncategory.js?v=<?php echo date('YmdHis') ?>"></script>
</body>

</html>