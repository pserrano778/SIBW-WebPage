<?php
require_once "./vendor/autoload.php";
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_REQUEST['idEvento']) and isset($_REQUEST['nuevoEstado'])){
        $idEvento = $_REQUEST['idEvento'];
        $nuevoEstado = $_REQUEST['nuevoEstado'];
        session_start();
        conectaABaseDeDatos();

        $exito = cambiarPublicacionEvento($idEvento, $nuevoEstado);
        
        desconectaDeBaseDeDatos();
        header("Location: ./listaEventos.php");
    }
}
?>