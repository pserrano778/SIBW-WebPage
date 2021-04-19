<?php
  require_once "./vendor/autoload.php";
  include("bd.php");

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['destino'])) {
      $error = 0;
      $pagAnterior = $_REQUEST['destino'];
      echo $twig->render('login.html', ['pagAnterior' => $pagAnterior, 'error' => $error]);
    }
  }
?>