function enviarTexto(){
    var comentario = document.getElementById("texto");
    var texto = comentario.value;
    $.ajax({
        dataType: 'Json',
        data: {texto},
        url: './busqueda.php',
        type: 'get',
        error: function (req, status, err) {
            alert('Something went wrong' + status + " " + err + " " + " " +  texto);
        },
        success: function(respuesta) {

            recibirTitulosEventos(respuesta);
        }
    });
}

function recibirTitulosEventos(respuesta) {
    var buscador = document.getElementById("livesearch");
    var hijos = buscador.childNodes;
    while(buscador.hasChildNodes()){
        buscador.removeChild(buscador.lastChild);
    }
    for (i = 0 ; i < respuesta.length ; i++) {
        var div = document.createElement('DIV');
        var enlace = document.createElement('A');
        enlace.text = respuesta[i]['titulo'];
        enlace.href = "evento.php?ev=" + respuesta[i].id;
        enlace.className = "enlaceEvento"; 
        div.appendChild(enlace);
        div.appendChild(document.createElement('BR'));
        buscador.appendChild(div);
    }
}