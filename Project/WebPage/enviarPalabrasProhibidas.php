<?php
    include("bd.php");
    conectaABaseDeDatos();

    $palabras = getPalabrasProhibidas();

    $myJSON = json_encode($palabras);

    echo $myJSON;
 
    desconectaDeBaseDeDatos();

?>