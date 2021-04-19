<?php
  require_once "./vendor/autoload.php";
  include("bd.php");

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  $usuario = 0;
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if(isset($_POST['idComentario'])){

      session_start();

      conectaABaseDeDatos();
      $comentario = getComentario($_POST['idComentario']);
      $_SESSION['tipo'] = getDatosUsuario($_SESSION['nickUsuario'])['tipo'];
      desconectaDeBaseDeDatos();

      $comentario['listaComentarios'] = 0; //Si viene de lista de comentarios sera 1

      if (isset($_SESSION['nickUsuario'])){
        $nombreUsuario = $_SESSION['nickUsuario'];
        $email = $_SESSION['emailUsuario'];
        $tipo = $_SESSION['tipo'];
        $usuario = ['nombreUsuario'=>$nombreUsuario, 'email'=>$email, 'tipo'=>$tipo];
      }
      if (isset($_REQUEST['listaComentarios'])){
        $comentario['listaComentarios'] = 1;
      }

      echo $twig->render('modificarComentario.html', ['comentario'=>$comentario, 'usuario'=>$usuario]);
    }
    
  }
?>