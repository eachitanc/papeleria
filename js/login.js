function LoginAuth() {
    ClearInvalid();
    var username = document.getElementById("txtUser");
    var password = document.getElementById("txtPass");
    var vigencia = document.getElementById('slcVigencia');
    var msg = '';
    if (username.value.trim() === "") {
        msg = 'Usuario no puede ser vacío';
        ShowAlertsModal(2, msg, username);
    } else if (password.value.trim() === "") {
        msg = 'Contraseña no puede ser vacío';
        ShowAlertsModal(2, msg, password);
    } else if (vigencia.value == 0) {
        msg = 'Debe seleccionar una vigencia';
        ShowAlertsModal(2, msg, vigencia);
    } else {
        const datos = new FormData();
        datos.append('usuario', username.value.trim());
        datos.append('password', hex_sha512(password.value.trim()));
        datos.append('vigencia', vigencia.value);
        var url = 'inicio/consultas/auth.php';
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
                    window.location.href = 'inicio/panel_control.php';
                } else {
                    let input = r.input === 'user' ? username : password;
                    ShowAlertsModal(2, r.msg, input);
                }
            })
            .catch(function (err) {
                ShowAlertsModal(2, err, null);
            });
    }
}
const verMayus = document.getElementById("txtPass");
const mayAct = document.getElementById("mayAct");
const toglePass = document.getElementById("toglePass");
verMayus.addEventListener("keydown", function (e) {
    var capsLockOn = (e.getModifierState && e.getModifierState("CapsLock")) || (e.key === "CapsLock");
    if (capsLockOn) {
        mayAct.style.display = "block";
    } else {
        mayAct.style.display = "none";
    }
});

verMayus.addEventListener("blur", function () {
    mayAct.style.display = "none";
});
toglePass.addEventListener("click", function () {
    const icono = toglePass.querySelector("i");
    if (verMayus.type === "text") {
        verMayus.type = "password";
        icono.classList.remove("fa-eye-slash", "link-secondary");
        icono.classList.add("fa-eye", "link-danger");
    } else {
        verMayus.type = "text";
        icono.classList.remove("fa-eye", "link-danger");
        icono.classList.add("fa-eye-slash", "link-secondary");
    }
});
