<script>
    function toggleArrow(link) {
        const icon = link.querySelector('i.arrowIcon');
        var estado = link.getAttribute('aria-expanded');
        if (estado == 'true') {
            icon.classList.add('fa-rotate-90');
        } else {
            icon.classList.remove('fa-rotate-90');
        }
    }
</script>
<script type="text/javascript" src="<?php echo $con->urlin ?>/js/mdb.min.js?v=<?php echo date('YmdHis') ?>"></script>
<script type="text/javascript" src="<?php echo $con->urlin ?>/comunes/js/funciones.js?v=<?php echo date('YmdHis') ?>"></script>
<script type="text/javascript" src="<?php echo $con->urlin ?>/js/jquery.js?v=<?php echo date('YmdHis') ?>"></script>
<script type="text/javascript" src="<?php echo $con->urlin ?>/js/jquery.dataTables.min.js?v=<?php echo date('YmdHis') ?>"></script>
<script type="text/javascript" src="<?php echo $con->urlin ?>/js/dataTables.buttons.min.js?v=<?php echo date('YmdHis') ?>"></script>
<script type="text/javascript" src="<?php echo $con->urlin ?>/js/jszip.min.js?v=<?php echo date('YmdHis') ?>"></script>
<script type="text/javascript" src="<?php echo $con->urlin ?>/js/pdfmake.min.js?v=<?php echo date('YmdHis') ?>"></script>
<script type="text/javascript" src="<?php echo $con->urlin ?>/js/vfs_fonts.js?v=<?php echo date('YmdHis') ?>"></script>
<script type="text/javascript" src="<?php echo $con->urlin ?>/js/buttons.html5.min.js?v=<?php echo date('YmdHis') ?>"></script>
<script type="text/javascript" src="<?php echo $con->urlin ?>/js/start.js?v=<?php echo date('YmdHis') ?>"></script>
<?php
if ($_SESSION['sidebar'] == '0') {
?>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            sidebar.classList.toggle('active');
            content.classList.toggle('active');
            var icono = document.querySelector('.navbar-toggler i');
            icono.classList.toggle('fa-bars');
            icono.classList.toggle('fa-ellipsis-v');
        }
        toggleSidebar();
    </script>
<?php
}
