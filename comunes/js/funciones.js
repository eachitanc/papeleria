const modalError = new mdb.Modal(document.getElementById('modalError'));
const modalDone = new mdb.Modal(document.getElementById('modalDone'));
const modalAlert = new mdb.Modal(document.getElementById('modalAlert'));
const modalForms = new mdb.Modal(document.getElementById('modalForms'));
const sizeModal = document.getElementById('tamForms');
const headForms = document.getElementById('modalFormsLabel');
const depto = document.getElementById('slcDepartamento');
const raiz = '/papeleria';
sizeModal.classList.remove('modal-fullscreen', 'modal-sm', 'modal-lg', 'modal-xl');

document.addEventListener('show.bs.modal', function (event) {
    var modals = document.querySelectorAll('.modal');
    var zIndex = 1040 + (10 * Array.from(modals).filter(function (modal) {
        return window.getComputedStyle(modal).display !== 'none';
    }).length);

    event.target.style.zIndex = zIndex;

    setTimeout(function () {
        var backdrops = document.querySelectorAll('.modal-backdrop:not(.modal-stack)');
        Array.from(backdrops).forEach(function (backdrop) {
            backdrop.style.zIndex = zIndex - 1;
            backdrop.classList.add('modal-stack');
        });
    }, 0);
}, true);
function AlertaConfiramar(nom, msg) {
    var nuevoBoton = document.createElement('button');
    nuevoBoton.type = 'button';
    nuevoBoton.className = 'btn btn-sm btn-primary';
    nuevoBoton.id = nom;
    nuevoBoton.textContent = 'Si';
    var footer = document.getElementById('modalAlertFooter');
    var alerta = document.getElementById('modalAlertMsg');
    alerta.textContent = msg;
    var botonExistente = footer.querySelector('button');
    footer.insertBefore(nuevoBoton, botonExistente);
}
function EliminaBoton(cont, elem) {
    const elemento = document.getElementById(elem);
    const contenedor = document.querySelector(cont);
    contenedor.removeChild(elemento);
}
function reloadtable(tableId) {
    const table = document.getElementById(tableId);
    if (table && table.classList.contains('dataTable')) {
        // Convertir a DataTable si aún no lo está
        const dataTable = new DataTable(table);
        dataTable.ajax.reload();
    } else {
        console.warn(`No se encontró una tabla DataTables con el ID "${tableId}".`);
    }
}
function ShowAlertsModal(tipo, msg, input) {
    switch (tipo) {
        case 1:
            document.getElementById("modalDoneMsg").innerHTML = msg;
            modalDone.show();
            break
        case 2:
            document.getElementById("modalErrorMsg").innerHTML = msg;
            if (input != null) {
                input.focus();
                input.classList.add("is-invalid");
            }
            modalError.show();
            break
        case 3:
            document.getElementById("modalAlertMsg").innerHTML = msg;
            modalAlert.show();
            break
    }
    return false;
};
function ClearInvalid() {
    const inputs = document.querySelectorAll("input", "select", "textarea");
    inputs.forEach(input => {
        input.classList.remove("is-invalid");
    });
};
function FetchData(url, formulario, table, param) {
    const datos = new FormData();
    if (param == 1) {
        var form = document.getElementById(formulario);
        var inputs = form.querySelectorAll('input, select', 'textarea');
        for (const input of inputs) {
            if (input.type === 'radio' && input.checked) {
                datos.append(input.name, input.value);
            } else if (input.type !== 'radio') {
                if (input.type === 'file') {
                    const file = input.files[0];
                    datos.append(input.name, file);
                } else {
                    datos.append(input.name, input.value);
                }
            };
        }
    } else {
        datos.append('id', formulario);
    }
    fetch(url, {
        method: 'POST',
        body: datos,
    })
        .then(function (response) {
            if (response.ok) {
                return response.json();
            } else {
                throw "Error en la llamada Ajax";
            }

        })
        .then(function (r) {
            if (r.status == 'ok') {
                reloadtable(table);
                ShowAlertsModal(1, 'Proceso realizado correctamente', null);
                modalForms.hide();
            } else {
                ShowAlertsModal(2, r.msg, null)
            }
        })
        .catch(function (err) {
            ShowAlertsModal(2, err, null)
        });
};
function MakePOST(url, datos, callback) {
    fetch(url, {
        method: "POST",
        body: datos,
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })
        .then(function (response) {
            return response.text();
        })
        .then(function (he) {
            callback(he);
        });
}

function PutMunicipio() {
    var id = document.getElementById('slcDepartamento').value;
    var datos = 'id=' + id;
    var url = raiz + '/comunes/php/putMunicipio.php'
    MakePOST(url, datos, function (he) {
        document.getElementById('slcMunicipio').innerHTML = he;
    });
}
