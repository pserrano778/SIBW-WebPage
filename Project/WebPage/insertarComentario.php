<?php
include("bd.php");

if (isset($_REQUEST['nombre']) and isset($_REQUEST['comentario']) and isset($_REQUEST['idEvento']) and isset($_REQUEST['email'])) {
    
    conectaABaseDeDatos();

    insertaComentario($_REQUEST['nombre'], $_REQUEST['comentario'], $_REQUEST['idEvento'], $_REQUEST['email']);
 
    desconectaDeBaseDeDatos();

}

header("Location: {$_REQUEST["destino"]}");
?>