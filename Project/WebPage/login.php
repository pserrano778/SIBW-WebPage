<?php
  require_once "./vendor/autoload.php";
  include("bd.php");
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if (isset($_POST['nombreUsuario']) and isset($_POST['password'])) {

      $nick = $_POST['nombreUsuario'];
      $pass = $_POST['password'];
      $email = "";
      $tipo = "";
      conectaABaseDeDatos();
  
      $exito = comprobarUsuario($_POST['nombreUsuario'], $_POST['password']);
      
      if($exito){
        $email = getDatosUsuario($nick)['email'];
        $tipo = getDatosUsuario($nick)['tipo'];
      }
      desconectaDeBaseDeDatos();

      if ($exito) {
        session_start();
        
        $_SESSION['nickUsuario'] = $nick;  // guardo en la sesión el nick del usuario que se ha logueado
        $_SESSION['emailUsuario'] = $email;
        $_SESSION['pagAnterior'] = $_REQUEST["destino"];
        $_SESSION['tipo'] = $tipo;
        header("Location: {$_REQUEST["destino"]}");
        exit();

      }
      else{
        $error = "Error: Nombre de usuario o contraseña incorrectos";
        $pagAnterior = $_REQUEST['destino'];
        echo $twig->render('login.html', ['pagAnterior' => $pagAnterior, 'error' => $error]);
      }
    } 
  }
  
?>