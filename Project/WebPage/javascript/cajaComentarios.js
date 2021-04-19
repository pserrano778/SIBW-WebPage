function mostrarCometarios() {
    var x = document.getElementById("globalCajaComentarios");
    if (x.style.display === "block") {
      x.style.display = "none";
    } else {
      x.style.display = "block";
    }
}

function comprobarCampos() {
    var nombre = document.getElementById("nombre");
    var email = document.getElementById("email");
    var comentario = document.getElementById("comentario");
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
    if (comentario.value == null || comentario.value.length == 0 || /^\s+$/.test(comentario.value)) {
        alert("Debe escribir un comentario");
        valido = false;
    }
        return valido;
}

var palabrasCensuradas = [];
var censura = [];

function censurarComentario() {
    
    var comentario = document.getElementById("comentario");

    var i;

    for (i = 0; i<palabrasCensuradas.length; i++) {
        var expresionRegular = new RegExp(palabrasCensuradas[i], "ig");
        comentario.value = comentario.value.replace(expresionRegular,censura[i]);
    }

    return true;
}

function enviarComentario() {

    let div =document.createElement('div');
    div.className ="estiloComentario";

    var nuevoNombre = document.getElementById("nombre").value;
    var nuevoTexto = document.getElementById("comentario").value;

    var fechaActual = new Date();
    var fechaCadena = "Enviado el "+ fechaActual.getDate() + "/" + (fechaActual.getMonth()+1) + "/" + fechaActual.getFullYear() + " a las " +fechaActual.getHours() + ":" + fechaActual.getMinutes();

    div.innerHTML="<p class=\"autorComentario\">" + nuevoNombre + "<p class=\"textoComentario\">" + nuevoTexto + "<p class=\"fechaHoraComentario\">" + fechaCadena;

    document.getElementById("nombre").value = "";
    document.getElementById("email").value = "";
    document.getElementById("comentario").value = "";
    document.getElementById("comentarios").appendChild(div);
}

function inicializarPalabrasProhibidas() {
    var xmlhttp = new XMLHttpRequest();
    var handleServerResponse = function() {
      if (this.readyState == 4 && this.status == 200) {
        palabrasCensuradas = JSON.parse(this.responseText); 
        censura = new Array(palabrasCensuradas.length);
        var i;
        var j;
        for (i = 0; i<palabrasCensuradas.length; i++) {
            var palabraCensurada = "";
            for (j=0; j<palabrasCensuradas[i].length; j++){
                palabraCensurada = palabraCensurada + "*";
            }
            censura[i] = palabraCensurada;  
        }
      }
    };
    xmlhttp.open("GET", "http://localhost/practica3/enviarPalabrasProhibidas.php", true);
    xmlhttp.onreadystatechange = handleServerResponse;
    xmlhttp.send();
}

function comprobarTextoComentario(){
    var comentario = document.getElementById("comentario");
    var valido = true;
    if (comentario.value == null || comentario.value.length == 0 || /^\s+$/.test(comentario.value)) {
        alert("Debe escribir un comentario");
        valido = false;
    }
    return valido;
}