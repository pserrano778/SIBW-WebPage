<?php
  require_once "./vendor/autoload.php";
  include("bd.php");
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cadena = "";

    session_start();
    $nombreUsuario = $_SESSION['nickUsuario'];
      
    conectaABaseDeDatos();

    if (isset($_POST['email'])) {

      $email = $_POST['email'];
    
      $exito = cambiarEmail($nombreUsuario, $email);
      
      if($exito){
        $cadena = "Se ha cambiado el email con éxito.";
        $_SESSION['emailUsuario'] = $email;
      } else{
        $cadena = "No se ha podido cambiar el email (Email ya registrado).";
      }
    } else if (isset($_POST['password'])) {
      $pass = $_POST['password'];
    
      $exito = cambiarPassword($nombreUsuario, $pass);
      
      if($exito){
        $cadena = "Se ha cambiado la contraseña con éxito.";
      } else{
        $cadena = "No se ha podido cambiar la contraseña.";
      }
    } else if (isset($_POST['descripcion'])) {
      $desc= $_POST['descripcion'];
    
      $exito = cambiarDescripcion($nombreUsuario, $desc);
      
      if($exito){
        $cadena = "Se ha cambiado la descripción con éxito.";
      } else{
        $cadena = "No se ha podido cambiar la dedscripción.";
      }
    }
    $_SESSION['tipo'] = getDatosUsuario($_SESSION['nickUsuario'])['tipo'];
    desconectaDeBaseDeDatos();

    if (isset($_SESSION['nickUsuario'])){
      $nombreUsuario = $_SESSION['nickUsuario'];
      $email = $_SESSION['emailUsuario'];
      $tipo = $_SESSION['tipo'];
      $usuario = ['nombreUsuario'=>$nombreUsuario, 'email'=>$email, 'tipo'=>$tipo];
    }

    echo $twig->render('modificarDatos.html', ['usuario' => $usuario,'cadena' => $cadena]);
  }
  
?>