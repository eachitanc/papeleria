const sidebar = document.getElementById('sidebar');
const content = document.getElementById('content');

document.querySelector('.navbar-toggler').addEventListener('click', function () {
    sidebar.classList.toggle('active');
    content.classList.toggle('active');
    var icono = document.querySelector('.navbar-toggler i');
    icono.classList.toggle('fa-bars');
    icono.classList.toggle('fa-ellipsis-v');
    fetch('consultas/sidebar.php', {
        method: 'POST',
    });
});