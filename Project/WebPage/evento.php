<?php
  require_once "./vendor/autoload.php";
  include("bd.php");
  
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  if (isset($_GET['ev'])) {
    $idEv = $_GET['ev'];
  } else {
    $idEv = -1;
  }
  $usuario = 0;
  session_start();
  conectaABaseDeDatos();
  $evento = getEvento($idEv);
  $comentarios = getComentariosEvento($idEv);
  if (isset($_SESSION['nickUsuario'])){
    $nombreUsuario = $_SESSION['nickUsuario'];
    $email = $_SESSION['emailUsuario'];
    
    $_SESSION['tipo'] = getDatosUsuario($_SESSION['nickUsuario'])['tipo'];

    $tipo = $_SESSION['tipo'];
    $usuario = ['nombreUsuario'=>$nombreUsuario, 'email'=>$email, 'tipo'=>$tipo];
  }
  desconectaDeBaseDeDatos();  

  if (isset($_SESSION['pagAnterior'])){
    $_SESSION['pagAnterior'] = "evento.php?ev=" . $idEv;
  }

  echo $twig->render('evento.html', ['evento' => $evento, 'idEvento' => $idEv, 'comentarios' => $comentarios, 'usuario' => $usuario]);
?>