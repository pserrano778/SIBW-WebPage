<?php
  require_once "./vendor/autoload.php";
  include("bd.php");

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  $usuario = 0;
  
  session_start();

  if (isset($_SESSION['nickUsuario'])){
    $nombreUsuario = $_SESSION['nickUsuario'];
    $tipo = $_SESSION['tipo'];
    $usuario = ['nombreUsuario'=>$nombreUsuario, 'tipo'=>$tipo];
  }

  echo $twig->render('nuevoEvento.html', ['usuario' => $usuario]);
?>
