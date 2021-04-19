<?php
  require_once "./vendor/autoload.php";
  include("bd.php");

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  session_start();
  conectaABaseDeDatos();
  $todosEventos = getUltimosEventos();
  $usuario = 0;
  if (isset($_SESSION['nickUsuario'])){
    $nombreUsuario = $_SESSION['nickUsuario'];
    $email = $_SESSION['emailUsuario'];

    $_SESSION['tipo'] = getDatosUsuario($_SESSION['nickUsuario'])['tipo'];
    
    $tipo = $_SESSION['tipo'];
    $usuario = ['nombreUsuario'=>$nombreUsuario, 'email'=>$email, 'tipo'=>$tipo];
  }
  desconectaDeBaseDeDatos();

  if (isset($_SESSION['pagAnterior'])){
    $_SESSION['pagAnterior'] = "index.php";
  }

  echo $twig->render('index.html', ['todosEventos' => $todosEventos, 'usuario' => $usuario]);
?>
