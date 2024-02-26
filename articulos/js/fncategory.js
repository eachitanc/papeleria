new DataTable('#tableCategory', {
  dom: 'Bfrtip',
  buttons: [
      {
          text: '<i class="fas fa-plus" title="Nueva Categoria"></i>',
          action: function (e, dt, node, config) {
              let url = 'formularios/form_reg_category.php';
              let datos = '';
              MakePOST(url, datos, function (he) {
                  document.getElementById('bodyForms').innerHTML = he;
              });
              sizeModal.classList.add('modal-lg');
              headForms.innerHTML = '<i class="fas fa-user-plus me-3"></i>NUEVO CATEGORIA';
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
      url: 'datos/list_category.php',
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

function save_category(opcion) {
    var url = opcion == 1 ? 'registrar/new_category.php' : 'actualizar/up_usuario.php';
    FetchData(url, 'formDatacategory', 'tableCategory', 1);
}

function EditaCategory(id) {
    let url = 'formularios/form_act_category.php';
    let datos = 'id=' + id;
    MakePOST(url, datos, function (he) {
        document.getElementById('bodyForms').innerHTML = he;
    });
    sizeModal.classList.add('modal-lg');
    headForms.innerHTML = '<i class="fas fa-user-plus me-3"></i>ACTUALIZAR CATEGORIA';
    modalForms.show();
}