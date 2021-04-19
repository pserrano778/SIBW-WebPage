<?php
include("bd.php");

$destino = "index.php";

session_start();
if (isset($_REQUEST['idEvento']) and $_SERVER['REQUEST_METHOD'] === 'POST') {
    conectaABaseDeDatos();
    borrarEvento($_REQUEST['idEvento']);
    desconectaDeBaseDeDatos();
}

header("Location: {$destino}");
?>