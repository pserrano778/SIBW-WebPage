<?php
include("bd.php");

session_start();
$destino = $_SESSION['pagAnterior'];
if (isset($_REQUEST['idComentario']) and isset($_REQUEST['comentario']) and $_SERVER['REQUEST_METHOD'] === 'POST') {
    conectaABaseDeDatos();
    modificarComentario($_REQUEST['idComentario'], $_REQUEST['comentario']);
    desconectaDeBaseDeDatos();
    if (isset($_REQUEST['listaComentarios'])){
        $destino = "listaComentarios.php";
    }
}

header("Location: {$destino}");
?>