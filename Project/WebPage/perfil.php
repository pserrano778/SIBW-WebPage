<?php
  require_once "./vendor/autoload.php";
  include("bd.php");

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  $usuario = 0;

  session_start();

  if (isset($_SESSION['nickUsuario'])){
    $nombreUsuario = $_SESSION['nickUsuario'];
    $email = $_SESSION['emailUsuario'];

    conectaABaseDeDatos();
    $_SESSION['tipo'] = getDatosUsuario($nombreUsuario)['tipo'];
    
    $tipo = $_SESSION['tipo'];
    $usuario = ['nombreUsuario'=>$nombreUsuario, 'email'=>$email, 'tipo'=>$tipo];

    $descripcion = getDatosUsuario($nombreUsuario)['descripcion'];
    desconectaDeBaseDeDatos();
   
    if ($descripcion == ""){
      $descripcion = "Aún no has añadido una descripción a tu perfil.";
    }
  }

  echo $twig->render('perfil.html', ['usuario' => $usuario, 'descripcion' => $descripcion]);
?>
