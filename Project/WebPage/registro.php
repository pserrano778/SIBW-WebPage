<?php
  require_once "./vendor/autoload.php";
  include("bd.php");
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    if (isset($_POST['nombreUsuario']) and isset($_POST['email']) and isset($_POST['password'])) {

      $nick = $_POST['nombreUsuario'];
      $email = $_POST['email'];
      $pass = $_POST['password'];
      conectaABaseDeDatos();
  
      $exito = registrarUsuario($_POST['nombreUsuario'], $_POST['email'], $_POST['password']);
      $tipo = getDatosUsuario($nick)['tipo'];
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
        $error = "Error: Nombre de usuario o correo eléctronico ya registrados";
        $pagAnterior = $_REQUEST['destino'];
        echo $twig->render('registro.html', ['pagAnterior' => $pagAnterior, 'error' => $error]);
      }
    } 
  }
  
?>