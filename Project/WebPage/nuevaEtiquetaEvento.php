<?php
require_once "./vendor/autoload.php";
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_REQUEST['etiqueta']) and isset($_REQUEST['idEvento'])){
          
            $etiqueta = $_REQUEST['etiqueta'];
            $idEvento = $_REQUEST['idEvento'];
            $mensaje = "El evento ya posee esa etiqueta";
            session_start();
            if (isset($_SESSION['nickUsuario'])){
                $nombreUsuario = $_SESSION['nickUsuario'];
                $tipo = $_SESSION['tipo'];
                $usuario = ['nombreUsuario'=>$nombreUsuario, 'tipo'=>$tipo];
            }
            conectaABaseDeDatos();
            
            $exito = nuevaEtiquetaEvento($idEvento, $etiqueta);
            $evento = getEvento($_POST['idEvento']);

            if ($exito){
                $mensaje = "Etiqueta añadida con éxito.";
            }
            
            echo $twig->render('./modificarEvento.html', ['evento'=>$evento, 'usuario' => $usuario, 'mensaje' => $mensaje]);
        
            desconectaDeBaseDeDatos();
        }
      }
?>