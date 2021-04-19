<?php
  require_once "./vendor/autoload.php";
  include("bd.php");

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  $usuario = 0;
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if(isset($_POST['idEvento'])){

      session_start();

      conectaABaseDeDatos();
      $evento = getEvento($_POST['idEvento']);
      $_SESSION['tipo'] = getDatosUsuario($_SESSION['nickUsuario'])['tipo'];
      desconectaDeBaseDeDatos();

      if (isset($_SESSION['nickUsuario'])){
        $nombreUsuario = $_SESSION['nickUsuario'];
        $email = $_SESSION['emailUsuario'];
        $tipo = $_SESSION['tipo'];
        $usuario = ['nombreUsuario'=>$nombreUsuario, 'email'=>$email, 'tipo'=>$tipo];
      }

      echo $twig->render('modificarEvento.html', ['evento'=>$evento, 'usuario'=>$usuario]);
    }
    
  }
?>