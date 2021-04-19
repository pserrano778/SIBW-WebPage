<?php
include("bd.php");

session_start();
$destino = $_SESSION['pagAnterior'];
if (isset($_REQUEST['idComentario']) and $_SERVER['REQUEST_METHOD'] === 'POST') {
    conectaABaseDeDatos();
    borrarComentario($_REQUEST['idComentario']);
    desconectaDeBaseDeDatos();
    if (isset($_REQUEST['listaComentarios'])){
        $destino = "listaComentarios.php";
    }
}

header("Location: {$destino}");
?>