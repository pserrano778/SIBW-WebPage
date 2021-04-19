<?php
require_once "./vendor/autoload.php";
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_REQUEST['nombreUsuario']) and isset($_REQUEST['nuevoTipo'])){
        $nombreUsuario = $_REQUEST['nombreUsuario'];
        $nuevoTipo = $_REQUEST['nuevoTipo'];
        session_start();
        conectaABaseDeDatos();

        $exito = cambiarPermisos($nombreUsuario, $nuevoTipo);

        $usuario = 0;
        if (isset($_SESSION['nickUsuario'])){
            $nombreUsuario = $_SESSION['nickUsuario'];
            $email = $_SESSION['emailUsuario'];
            $_SESSION['tipo'] = getDatosUsuario($_SESSION['nickUsuario'])['tipo'];
            $tipo = $_SESSION['tipo'];
            $usuario = ['nombreUsuario'=>$nombreUsuario, 'email'=>$email, 'tipo'=>$tipo];
        }
        
        $usuarios = getUsuarios($nombreUsuario);
        desconectaDeBaseDeDatos();
        $error = 0;
        if (!$exito){
            echo ("entro");
            $error = "Error: No puede haber menos de 1 superusuario.";
        }
        echo $twig->render('listaUsuarios.html', ['usuarios' => $usuarios, 'usuario' => $usuario, 'error' => $error]);
    }
}
?>