new DataTable('#tableUsuarios', {
    dom: 'Bfrtip',
    buttons: [
        {
            text: '<i class="fas fa-plus" title="Nuevo Usuario"></i>',
            action: function (e, dt, node, config) {
                let url = 'formularios/form_reg_usuario.php';
                let datos = '';
                MakePOST(url, datos, function (he) {
                    document.getElementById('bodyForms').innerHTML = he;
                });
                sizeModal.classList.add('modal-lg');
                headForms.innerHTML = '<i class="fas fa-user-plus me-3"></i>NUEVO USUARIO';
                modalForms.show();
            },
            className: 'btn btn-primary'
        },
        {
            extend: 'copyHtml5',
            className: 'btn btn-info'
        },
        {
            extend: 'excelHtml5',
            className: 'btn btn-success'
        },
        {
            extend: 'csvHtml5',
            className: 'btn btn-secondary'
        },
        {
            extend: 'pdfHtml5',
            className: 'btn btn-danger'
        }
    ],
    search: {
        return: true
    },
    language: {
        url: '../comunes/json/dataTableIdioma.json'
    },
    ajax: {
        url: 'datos/listado.php',
        type: 'POST',
        dataType: 'json',
    },
    lengthMenu: [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, 'Todo']
    ],
    pageLength: -1,
    order: [[0, 'asc']],
});
function ToggleStatus(id) {
    var url = 'actualizar/status_user.php';
    FetchData(url, id, 'tableUsuarios', 2)
}