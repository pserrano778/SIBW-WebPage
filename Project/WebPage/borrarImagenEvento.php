<?php
require_once "./vendor/autoload.php";
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

    session_start();
    if (isset($_REQUEST['idBorrarImagen']) and $_SERVER['REQUEST_METHOD'] === 'POST') {
        conectaABaseDeDatos();
        borrarImagenEvento($_REQUEST['idBorrarImagen']);

        if (isset($_SESSION['nickUsuario'])){
            $nombreUsuario = $_SESSION['nickUsuario'];
            $tipo = $_SESSION['tipo'];
            $usuario = ['nombreUsuario'=>$nombreUsuario, 'tipo'=>$tipo];
        }

        $evento = getEvento($_POST['idEvento']);
        desconectaDeBaseDeDatos();
        $mensaje = "Imagen eliminada con éxito.";
        echo $twig->render('./modificarEvento.html', ['evento'=>$evento, 'usuario' => $usuario, 'mensaje' => $mensaje]);
    }

?>