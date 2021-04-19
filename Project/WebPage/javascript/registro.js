function comprobarCampos() {
    var nombre = document.getElementById("nombreUsuario");
    var email = document.getElementById("email");
    var pass = document.getElementById("password");
    var valido = true;
    if (nombre.value == null || nombre.value.length == 0 || /^\s+$/.test(nombre.value)) {
        alert("Debe introducir un nombre");
        valido = false;
    }
    if (email.value == null || email.value.length == 0 || /^\s+$/.test(email.value)) {
        alert("Debe introducir un correo electrónico");
        valido = false;
    } else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email.value))){
        alert ("Debe introducir un correo electrónico válido (algo@algo.algo)");
        valido = false;
    }
    if (pass.value == null || pass.value.length == 0 || /^\s+$/.test(pass.value)) {
        alert("Debe escribir una contraseña");
        valido = false;
    }

    return valido;
}