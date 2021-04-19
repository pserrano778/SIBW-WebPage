<?php
  function getEvento($idEv) {

    global $mysqli;
    $consulta_1 = $mysqli->prepare("SELECT nombre, lugar, organizador, descripcion, fecha, textoImagenPortada FROM eventos WHERE id = ?");
    $consulta_1->bind_param("i", $idEv);
    $consulta_1->execute();
    $res = $consulta_1->get_result();

    $evento = array('nombre' => 'XXX', 'lugar' => 'YYY', 'organizador' => 'ZZZ', 'descripcion' => 'Descripción del evento', 'fecha' => 'DD/MM/YYYY');

    $consulta_2 = $mysqli->prepare("SELECT idImagen, rutaImagen, textImagen FROM imagenes WHERE idEvento = ?");
    $consulta_2->bind_param("i", $idEv);
    $consulta_2->execute();
    $res_imagenes = $consulta_2->get_result();

    $consulta_3 = $mysqli->prepare("SELECT enlace, textoEnlace FROM enlacesevento WHERE idEvento = ?");
    $consulta_3->bind_param("i", $idEv);
    $consulta_3->execute();
    $res_enlaces = $consulta_3->get_result();

    $consulta_4 = $mysqli->prepare("SELECT etiqueta FROM etiquetaseventos WHERE idEvento = ?");
    $consulta_4->bind_param("i", $idEv);
    $consulta_4->execute();
    $res_etiquetas = $consulta_4->get_result();

    if ($res->num_rows > 0) {
      $row = $res->fetch_assoc();
      $imagenes = array();
      $enlaces = array();
      $etiquetas = array();
      if ($res_imagenes->num_rows > 0) {

        for ($i=0; $i<$res_imagenes->num_rows; $i++) {
          $img = $res_imagenes->fetch_assoc();
          $imagen = array('idImagen' => $img['idImagen'], 'ruta' => $img['rutaImagen'], 'texto' => $img['textImagen']);
          $imagenes[] = $imagen;
        }
      }

      if ($res_enlaces->num_rows > 0) {

        for ($i=0; $i<$res_enlaces->num_rows; $i++) {
          $enlc = $res_enlaces->fetch_assoc();
          $enlace = array('enlace' => $enlc['enlace'], 'texto' => $enlc['textoEnlace']);
          $enlaces[] = $enlace;
        }
      }

      if ($res_etiquetas->num_rows > 0) {

        for ($i=0; $i<$res_etiquetas->num_rows; $i++) {
          $et = $res_etiquetas->fetch_assoc();
          $etiqueta = array('etiqueta' => $et['etiqueta']);
          $etiquetas[] = $etiqueta;
        }
      }
        
      $date = new DateTime($row['fecha']);
      $date = $date->format('d-m-Y');
      $dateOriginal = new DateTime($row['fecha']);
      $dateOriginal = $dateOriginal->format('Y-m-d');
      $evento = array('idEvento' => $idEv, 'nombre' => $row['nombre'], 'lugar' => $row['lugar'], 'organizador' =>  $row['organizador'], 'descripcion' =>  $row['descripcion'], 'textoPortada' =>  $row['textoImagenPortada'], 'fecha' =>  $date, 'fechaOriginal' =>  $dateOriginal, 'imagenes' => $imagenes, 'enlacesAdicionales' => $enlaces, 'etiquetas' => $etiquetas);
    }
    
    return $evento;
  }

  function getTodosEventos() {
    global $mysqli;
    $res_todos_eventos = $mysqli->query("SELECT id, rutaImagenPortada, textoImagenPortada, publicado FROM eventos");

    $eventos = array();

    if ($res_todos_eventos->num_rows > 0) {
      for ($i=0; $i<$res_todos_eventos->num_rows; $i++) {
        $ev = $res_todos_eventos->fetch_assoc();
        $consulta = getEtiquetasEvento($ev['id']);
        $evento = array('idEvento' => $ev['id'], 'ruta' => $ev['rutaImagenPortada'], 'texto' => $ev['textoImagenPortada'], 'etiquetas' => $consulta, 'publicado' => $ev['publicado']);
        $eventos[] = $evento;
      }
    }
    
    return $eventos;
  }

  function getUltimosEventos() {
    global $mysqli;
    $res_todos_eventos = $mysqli->query("SELECT id, rutaImagenPortada, textoImagenPortada FROM eventos where publicado = '1'");

    $eventos = array();

    if ($res_todos_eventos->num_rows > 0) {
      
      for ($i=0; $i<$res_todos_eventos->num_rows; $i++) {
        $ev = $res_todos_eventos->fetch_assoc();
        if ($res_todos_eventos->num_rows-$i <=6 ){
          $consulta = getEtiquetasEvento($ev['id']);
          $evento = array('idEvento' => $ev['id'], 'ruta' => $ev['rutaImagenPortada'], 'texto' => $ev['textoImagenPortada'], 'etiquetas' => $consulta);
          $eventos[] = $evento;
        }
      }
    }
    
    return $eventos;
  }

  function cambiarPublicacionEvento($idEvento, $nuevoEstado){
    global $mysqli;

    $update = $mysqli->prepare("UPDATE eventos SET publicado = ? WHERE eventos.id = ?");
    $update->bind_param("ii", $nuevoEstado, $idEvento);

    return $update->execute();
  }

  function getEventosConPalabra($palabra){
    global $mysqli;
    $consulta_1 = $mysqli->prepare("SELECT id, rutaImagenPortada, textoImagenPortada, publicado FROM eventos WHERE descripcion LIKE ?");
    $cad = "%" . $palabra . "%";
    $consulta_1->bind_param("s", $cad);
    $consulta_1->execute();
    $res = $consulta_1->get_result();

    $eventos = array();
    if ($res->num_rows > 0) {
      for ($i=0; $i<$res->num_rows; $i++) {
        $ev = $res->fetch_assoc();
        $consulta = getEtiquetasEvento($ev['id']);
        $evento = array('idEvento' => $ev['id'], 'ruta' => $ev['rutaImagenPortada'], 'texto' => $ev['textoImagenPortada'], 'etiquetas' => $consulta, 'publicado' => $ev['publicado']);
        $eventos[] = $evento;
      }
    }

    return $eventos;
  }

  function getTitulosEventosConTexto($texto, $tipo){
    global $mysqli;
    $consulta;
    $cad = "%" . $texto . "%";
    
    if ($tipo == "gestor" || $tipo == "super"){
      $consulta = $mysqli->prepare("SELECT textoImagenPortada, id FROM eventos WHERE descripcion LIKE ? OR nombre LIKE ?");
      $consulta->bind_param("ss",$cad, $cad);
      $consulta->execute();
    }
    else{
      $consulta = $mysqli->prepare("SELECT textoImagenPortada, id FROM eventos WHERE publicado = '1' AND (descripcion LIKE ? OR nombre LIKE ?)");
      $consulta->bind_param("ss", $cad, $cad);
      $consulta->execute();
    }
    
    $res = $consulta->get_result();
    $titulos = array();
    if ($res->num_rows > 0) {
      for ($i=0; $i<$res->num_rows; $i++) {
        $title = $res->fetch_assoc();
        $titulo= array('titulo' => $title['textoImagenPortada'], 'id' => $title['id']);
        $titulos[] = $titulo;
      }
    }

    return $titulos;
  }

  function getComentariosEvento($idEv) {
    global $mysqli;
    $consulta = $mysqli->prepare("SELECT idComentario, autorComentario, textoComentario, fechaComentario,	modificadoPorMod FROM comentarios WHERE idEvento = ?");
    $consulta->bind_param("i", $idEv);
    $consulta->execute();
    $res = $consulta->get_result();
    $comentarios = array();

    if ($res->num_rows > 0) {

      for ($i=0; $i<$res->num_rows; $i++) {
          $comnt = $res->fetch_assoc();
          $comentario = array('idComentario' => $comnt['idComentario'], 'autor' => $comnt['autorComentario'], 'texto' => $comnt['textoComentario'], 'fecha' => $comnt['fechaComentario'], 'modificado' => $comnt['modificadoPorMod']);
          $comentarios[] = $comentario;
      }
    }
    return $comentarios;
  }

  function insertaComentario($autor, $texto, $idEv, $email){
    global $mysqli;
    $insertar = $mysqli->prepare("INSERT INTO comentarios (autorComentario, textoComentario, idEvento, email) VALUES (?, ?, ?, ?)");

    $insertar->bind_param("ssis", $autor, $texto, $idEv, $email);
    $insertar->execute();

  }

  function borrarComentario($idComentario){
    global $mysqli;
    $borrar = $mysqli->prepare("DELETE FROM comentarios WHERE comentarios.idComentario = ?");

    $borrar->bind_param("i", $idComentario);
    $borrar->execute();
  }

  function modificarComentario($idComentario, $textoComentario){
    global $mysqli;
    $modificado = 1;
    $modificar = $mysqli->prepare("UPDATE comentarios SET comentarios.textoComentario = ?, comentarios.modificadoPorMod = ? WHERE comentarios.idComentario = ?");
    $modificar->bind_param("sii", $textoComentario, $modificado, $idComentario);
    $modificar->execute();
  }

  function getComentario($idComentario){
    global $mysqli;

    $consulta = $mysqli->prepare("SELECT * FROM comentarios WHERE comentarios.idComentario = ?");

    $consulta->bind_param("i", $idComentario);
    $consulta->execute();
    $res = $consulta->get_result();
    $comentario = $res->fetch_assoc();

    return $comentario;
  }

  function getComentarios(){
    global $mysqli;
    $res = $mysqli->query("SELECT * FROM comentarios");
    $comentarios = array();

    if ($res->num_rows > 0) {
      for ($i=0; $i<$res->num_rows; $i++) {
          $comnt = $res->fetch_assoc();
          $comentario = array('idComentario' => $comnt['idComentario'], 'autor' => $comnt['autorComentario'], 'texto' => $comnt['textoComentario'], 'fecha' => $comnt['fechaComentario'], 'modificado' => $comnt['modificadoPorMod']);
          $comentarios[] = $comentario;
      }
    }
    return $comentarios;
  }

  function getPalabrasProhibidas(){
    global $mysqli;
    $res = $mysqli->query("SELECT palabra FROM palabrasprohibidas");

    $palabras = array();
    if ($res->num_rows > 0) {
      for ($i=0; $i<$res->num_rows; $i++) {
        $palabra = $res->fetch_assoc();      
        $palabras[] = $palabra['palabra'];
      }
    }

    return $palabras;
  }

  function registrarUsuario($nombre, $email, $pass){
    global $mysqli;
    $insertar = $mysqli->prepare("INSERT INTO usuarios (email, nombreUsuario, password) VALUES (?, ?, ?)");

    $passCodificada = password_hash($pass, PASSWORD_DEFAULT);
    $insertar->bind_param("sss", $email, $nombre, $passCodificada);
    return $insertar->execute();
  }

  function comprobarUsuario($nombre, $pass){
    global $mysqli;
    $exito = false;

    $consulta = $mysqli->prepare("SELECT password FROM usuarios WHERE nombreUsuario = ?");
    $consulta->bind_param("s", $nombre);
    $consulta->execute();
    $res = $consulta->get_result();

    if ($res->num_rows > 0) {
      if (password_verify($pass, $res->fetch_assoc()['password'])){
        $exito = true;
      }
    }

    return $exito;
  }

  function getDatosUsuario($nombre){
    global $mysqli;
    $consulta = $mysqli->prepare("SELECT * FROM usuarios WHERE nombreUsuario = ?");
    $consulta->bind_param("s", $nombre);
    $consulta->execute();
    $res = $consulta->get_result();

    $datos = $res->fetch_assoc();

    return $datos;
  }

  function cambiarEmail($usuario, $email){
    global $mysqli;

    $update = $mysqli->prepare("UPDATE usuarios SET email = ? WHERE usuarios.nombreUsuario = ?");
    $update->bind_param("ss", $email,$usuario);

    return $update->execute();
  }

  function cambiarPassword($usuario, $pass){
    global $mysqli;

    $passCodificada = password_hash($pass, PASSWORD_DEFAULT);

    $update = $mysqli->prepare("UPDATE usuarios SET password = ? WHERE usuarios.nombreUsuario = ?");
    $update->bind_param("ss", $passCodificada,$usuario);

    return $update->execute();
  }

  function cambiarDescripcion($usuario, $descripcion){
    global $mysqli;

    $update = $mysqli->prepare("UPDATE usuarios SET descripcion = ? WHERE usuarios.nombreUsuario = ?");
    $update->bind_param("ss", $descripcion,$usuario);

    return $update->execute();
  }

  function getEtiquetas(){
      global $mysqli;
      $res = $mysqli->query("SELECT etiqueta FROM etiquetaseventos");
  
      $etiquetas = array();
  
      if ($res->num_rows > 0) {
        for ($i=0; $i<$res->num_rows; $i++) {
          $et= $res->fetch_assoc();
          $etiqueta = array('etiqueta' => $et['etiqueta']);
          $etiquetas[] = $etiqueta;
        }
      }
      return $etiquetas;
  }

  function getEtiquetasEvento($idEvento){
    global $mysqli;
    $consulta = $mysqli->prepare("SELECT etiqueta FROM etiquetaseventos where idEvento = ?");
    $consulta->bind_param("i", $idEvento);
    $consulta->execute();
    $res = $consulta->get_result();

    $etiquetas = array();

    if ($res->num_rows > 0) {
      for ($i=0; $i<$res->num_rows; $i++) {
        $et= $res->fetch_assoc();
        $etiqueta = array('etiqueta' => $et['etiqueta']);
        $etiquetas[] = $etiqueta;
      }
    }
    return $etiquetas;
  }

  function insertarEvento($nombre, $lugar, $fecha, $organizador, $descripcion, $imgPortada, $textoPortada){
    global $mysqli;
    $insertar = $mysqli->prepare("INSERT INTO eventos (id, nombre, lugar, descripcion, organizador, fecha, rutaImagenPortada, textoImagenPortada) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?);");

    $insertar->bind_param("sssssss", $nombre, $lugar, $descripcion, $organizador, $fecha, $imgPortada, $textoPortada);
    $insertar->execute();
  }

  function modificarEvento($id, $nombre, $lugar, $fecha, $organizador, $descripcion, $imgPortada, $textoPortada){
    global $mysqli;
    if ($imgPortada != ""){
      $insertar = $mysqli->prepare("UPDATE eventos SET nombre = ?, lugar = ?, descripcion = ?, organizador = ?, fecha = ?, rutaImagenPortada = ?, textoImagenPortada = ? WHERE eventos.id = ?;");
      $insertar->bind_param("sssssssi", $nombre, $lugar, $descripcion, $organizador, $fecha, $imgPortada, $textoPortada, $id);
      $insertar->execute();
    } else{
        $insertar = $mysqli->prepare("UPDATE eventos SET nombre = ?, lugar = ?, descripcion = ?, organizador = ?, fecha = ?, textoImagenPortada = ? WHERE eventos.id = ?;");
        $insertar->bind_param("ssssssi", $nombre, $lugar, $descripcion, $organizador, $fecha, $textoPortada, $id);
        $insertar->execute();
    }
  }

  function borrarEvento($idEvento){
    global $mysqli;
    $borrar = $mysqli->prepare("DELETE FROM eventos WHERE eventos.id = ?");

    $borrar->bind_param("i", $idEvento);
    $borrar->execute();
  }

  function nuevaImagenEvento($idEvento, $textoImagen, $imgEvento){
    global $mysqli;
    $insertar = $mysqli->prepare("INSERT INTO imagenes (idImagen, rutaImagen, idEvento, textImagen) VALUES (NULL, ?, ?, ?)");

    $insertar->bind_param("sis", $imgEvento, $idEvento, $textoImagen);
    $insertar->execute();
  }

  function borrarImagenEvento($idImagen){
    global $mysqli;
    $borrar = $mysqli->prepare("DELETE FROM imagenes WHERE imagenes.idImagen = ?");

    $borrar->bind_param("i", $idImagen);
    $borrar->execute();
  }

  function borrarEtiquetaEvento($etiqueta, $idEvento){
    global $mysqli;
    $borrar = $mysqli->prepare("DELETE FROM etiquetaseventos WHERE etiquetaseventos.etiqueta = ? AND etiquetaseventos.idEvento = ?");

    $borrar->bind_param("si", $etiqueta, $idEvento);
    $borrar->execute();
  }

  function nuevaEtiquetaEvento($idEvento, $etiqueta){
    global $mysqli;
    $insertar = $mysqli->prepare("INSERT INTO etiquetaseventos (etiqueta, idEvento) VALUES (?, ?)");

    $insertar->bind_param("si", $etiqueta, $idEvento);
    return $insertar->execute();
  }

  function getUsuarios($nombreUsuario){
    global $mysqli;
    $res = $mysqli->query("SELECT email, nombreUsuario, tipo FROM usuarios");

    if ($res->num_rows > 0) {
      $usuarios = array();
      for ($i=0; $i<$res->num_rows; $i++) {
        $usu = $res->fetch_assoc();
        $usuario = array('email' => $usu['email'], 'nombreUsuario' => $usu['nombreUsuario'], 'tipo' => $usu['tipo']);
        $usuarios[] = $usuario;
      }
    }

    return $usuarios;
  }

  function cambiarPermisos($nombreUsuario, $nuevoTipo){
    global $mysqli;

    $exito = true;
    if ($nuevoTipo != "super"){
      $consulta = $mysqli->prepare("SELECT tipo FROM usuarios WHERE usuarios.nombreUsuario = ?");
      $consulta->bind_param("s", $nombreUsuario);
      $consulta->execute();
      $res = $consulta->get_result();
      $datos = $res->fetch_assoc();
      if ($datos['tipo'] == "super"){
        $res2 = $mysqli->query("SELECT * FROM usuarios WHERE usuarios.tipo = 'super'");
        if ($res2->num_rows < 2){
          $exito = false;
        }
      }
    }
      

    if ($exito){
      $update = $mysqli->prepare("UPDATE usuarios SET tipo = ? WHERE usuarios.nombreUsuario = ?");
      $update->bind_param("ss", $nuevoTipo, $nombreUsuario);
      $update->execute();
    }

    return $exito;
  }

  function conectaABaseDeDatos() {
    global $mysqli;
    $mysqli = new mysqli("localhost", "SIBW", "sibw", "sibw");
    if ($mysqli->connect_errno) {
      echo ("Fallo al conectar: " . $mysqli->connect_error);
    }
  }

  function desconectaDeBaseDeDatos() {
    global $mysqli;
    $mysqli->close();
  }
?>
