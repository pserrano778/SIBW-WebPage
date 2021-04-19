<?php
require_once "./vendor/autoload.php";
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_REQUEST['nombre']) and isset($_REQUEST['lugar']) and isset($_REQUEST['organizador']) and isset($_REQUEST['fecha']) and isset($_REQUEST['descripcion']) and isset($_REQUEST['textoPortada'])){
          
            $nombre = $_REQUEST['nombre'];
            $lugar = $_REQUEST['lugar'];
            $organizador = $_REQUEST['organizador'];
            $fecha = $_REQUEST['fecha'];
            $descripcion = $_REQUEST['descripcion'];
            $imgPortada = "";
            $errorImagenes = array();
            $errors= array();
            $textoPortada = $_REQUEST['textoPortada'];

            if(isset($_FILES['imagenPortada'])){
                if ($_FILES['imagenPortada']['name'] != ""){
                    $file_name = $_FILES['imagenPortada']['name'];
                    $file_size = $_FILES['imagenPortada']['size'];
                    $file_tmp = $_FILES['imagenPortada']['tmp_name'];
                    $file_type = $_FILES['imagenPortada']['type'];
                    $var = explode('.',$_FILES['imagenPortada']['name']);
                    $file_ext = strtolower(end($var));
                    
                    $extensions= array("jpeg","jpg","png","jfif");
                    
                    if (in_array($file_ext,$extensions) === false){
                    $errors[] = "Imagen portada: Extensión no permitida, elige una imagen JPEG, PNG o JFIF.";
                    }
                    
                    if ($file_size > 2097152){
                    $errors[] = 'Imagen portada: Tamaño del fichero demasiado grande.';
                    }
                    
                    if (empty($errors)==true) {
                        move_uploaded_file($file_tmp, "imagenes/" . $file_name);
                        $imgPortada = "imagenes/" . $file_name;
                    }
                    else{
                        $errorImagenes['portada'] = $errors;
                    }
                }
                else{
                    $errors[] = "Elija una imagen para la portada.";
                    $errorImagenes['portada'] = $errors;
                }
            }
            if (sizeof($errors) > 0) {
                session_start();
                if (isset($_SESSION['nickUsuario'])){
                    $nombreUsuario = $_SESSION['nickUsuario'];
                    $tipo = $_SESSION['tipo'];
                    $usuario = ['nombreUsuario'=>$nombreUsuario, 'tipo'=>$tipo];
                  }
                echo $twig->render('./nuevoEvento.html', ['usuario' => $usuario, 'erroresImagenes'=>$errorImagenes]);
            } else{
                conectaABaseDeDatos();
                insertarEvento($nombre, $lugar, $fecha, $organizador, $descripcion, $imgPortada, $textoPortada);
                desconectaDeBaseDeDatos();
                header("Location: listaEventos.php");
            }
        }
      }
?>