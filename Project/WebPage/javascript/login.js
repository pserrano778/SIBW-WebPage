function comprobarCampos() {
    var nombre = document.getElementById("nombreUsuario");
    var pass = document.getElementById("password");
    var valido = true;
    if (nombre.value == null || nombre.value.length == 0 || /^\s+$/.test(nombre.value)) {
        alert("Debe introducir un nombre");
        valido = false;
    }
    if (pass.value == null || pass.value.length == 0 || /^\s+$/.test(pass.value)) {
        alert("Debe escribir una contraseña");
        valido = false;
    }

    return valido;
}