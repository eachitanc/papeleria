const modalError = new mdb.Modal(document.getElementById('modalError'));
const modalDone = new mdb.Modal(document.getElementById('modalDone'));
const modalAlert = new mdb.Modal(document.getElementById('modalAlert'));
const modalForms = new mdb.Modal(document.getElementById('modalForms'));
const sizeModal = document.getElementById('tamForms');
const headForms = document.getElementById('modalFormsLabel');
sizeModal.classList.remove('modal-fullscreen', 'modal-sm', 'modal-lg', 'modal-xl');

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
                ShowAlertsModal(1, 'Estado modificado correctamente', null);
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