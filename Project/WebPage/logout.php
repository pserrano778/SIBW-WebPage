<?php
  session_start();
  $destino = $_SESSION["pagAnterior"];
  session_destroy();
  header("Location: {$destino}");
    
  exit();
?>
