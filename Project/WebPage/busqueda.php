<?php
  include("bd.php");

  header('Content-Type: application/json');

  $titulosEventos = array();

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    if (isset($_GET['texto'])) {
      session_start();
      conectaABaseDeDatos();

      $texto = $_GET['texto'];

      $tipo = 'normal';
      if (isset($_SESSION['tipo'])){
        $tipo = $_SESSION['tipo'];
      }
      if ($texto != ""){
        $titulosEventos = getTitulosEventosConTexto($texto, $tipo);
      }
      desconectaDeBaseDeDatos();
    }
  }
  echo(json_encode($titulosEventos));
?>

