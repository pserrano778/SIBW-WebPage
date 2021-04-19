function comprobarEmail() {
    var email = document.getElementById("email");
    var valido = true;
    if (email.value == null || email.value.length == 0 || /^\s+$/.test(email.value)) {
        alert("Debe introducir un correo electrónico");
        valido = false;
    } else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(email.value))){
        alert ("Debe introducir un correo electrónico válido (algo@algo.algo)");
        valido = false;
    }
    return valido;
}

function comprobarDescripcion() {
    var descripcion = document.getElementById("descripcion");
    var valido = true;
    if (descripcion.value == null || descripcion.value.length == 0 || /^\s+$/.test(descripcion.value)) {
        alert("Debe introducir una descripción");
        valido = false;
    }
    return valido;
}

function comprobarPass() {
    var pass = document.getElementById("password");
    var valido = true;
    if (pass.value == null || pass.value.length == 0 || /^\s+$/.test(pass.value)) {
        alert("Debe introducir una contraseña");
        valido = false;
    }
    return valido;
}