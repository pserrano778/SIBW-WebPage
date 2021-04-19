function comprobarCampos() {
    var nombre = document.getElementById("nombre");
    var lugar = document.getElementById("lugar");
    var organizador = document.getElementById("organizador");
    var fecha = document.getElementById("fecha");
    var descripcion = document.getElementById("descripcion");
    var tPortada = document.getElementById("textoPortada");

    var valido = true;
    if (nombre.value == null || nombre.value.length == 0 || /^\s+$/.test(nombre.value)) {
        alert("Debe introducir un nombre para el evento");
        valido = false;
    }
    if (lugar.value == null || lugar.value.length == 0 || /^\s+$/.test(lugar.value)) {
        alert("Debe introducir el lugar en el que se celebrará el evento");
        valido = false;
    }
    if (organizador.value == null || organizador.value.length == 0 || /^\s+$/.test(organizador.value)) {
        alert("Debe introducir el organizador del evento");
        valido = false;
    }
    if (fecha.value == null || fecha.value.length == 0) {
        alert("Debe introducir la fecha en la que dará comienzo el evento");
        valido = false;
    }
    if (descripcion.value == null || descripcion.value.length == 0 || /^\s+$/.test(descripcion.value)) {
        alert("Debe introducir la descripción del evento");
        valido = false;
    }
    if (tPortada.value == null || tPortada.value.length == 0 || /^\s+$/.test(tPortada.value)) {
        alert("Debe introducir el texto para la portada");
        valido = false;
    }

    return valido;
}

function comprobarTextoImagen() {
    var nombre = document.getElementById("textoImagen");

    var valido = true;
    if (nombre.value == null || nombre.value.length == 0 || /^\s+$/.test(nombre.value)) {
        alert("Debe introducir un texto para la imagen");
        valido = false;
    }
    return valido;
}

function comprobarTextoEtiqueta() {
    var nombre = document.getElementById("etiqueta");

    var valido = true;
    if (nombre.value == null || nombre.value.length == 0 || /^\s+$/.test(nombre.value)) {
        alert("Debe introducir uns etiqueta");
        valido = false;
    }
    return valido;
}