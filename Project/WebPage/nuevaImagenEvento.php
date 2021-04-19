<?php
require_once "./vendor/autoload.php";
include("bd.php");

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_REQUEST['textoImagen']) and isset($_REQUEST['idEvento'])){
          
            $textoImagen = $_REQUEST['textoImagen'];
            $idEvento = $_REQUEST['idEvento'];
            $imgEvento = "";
            $errors= array();
            if(isset($_FILES['imagenEvento'])){
                if ($_FILES['imagenEvento']['name'] != ""){
                    $file_name = $_FILES['imagenEvento']['name'];
                    $file_size = $_FILES['imagenEvento']['size'];
                    $file_tmp = $_FILES['imagenEvento']['tmp_name'];
                    $file_type = $_FILES['imagenEvento']['type'];
                    $var = explode('.',$_FILES['imagenEvento']['name']);
                    $file_ext = strtolower(end($var));
                    
                    $extensions= array("jpeg","jpg","png","jfif");
                    
                    if (in_array($file_ext,$extensions) === false){
                    $errors[] = "Imagen evento: Extensión no permitida, elige una imagen JPEG, PNG o JFIF.";
                    }
                    
                    if ($file_size > 2097152){
                    $errors[] = 'Imagen evento: Tamaño del fichero demasiado grande.';
                    }
                    
                    if (empty($errors)==true) {
                        move_uploaded_file($file_tmp, "imagenes/" . $file_name);
                        $imgEvento = "imagenes/" . $file_name;
                    }
                }
                else{
                    $errors[] = "Elija una imagen para el evento.";
                }
            }
            session_start();
            if (isset($_SESSION['nickUsuario'])){
                $nombreUsuario = $_SESSION['nickUsuario'];
                $tipo = $_SESSION['tipo'];
                $usuario = ['nombreUsuario'=>$nombreUsuario, 'tipo'=>$tipo];
            }
            conectaABaseDeDatos();
            if (sizeof($errors) > 0) {
                $evento = getEvento($_POST['idEvento']);
                echo $twig->render('./modificarEvento.html', ['evento'=>$evento, 'usuario' => $usuario, 'erroresImagenes'=>$errors]);
            } else{
                nuevaImagenEvento($idEvento, $textoImagen, $imgEvento);
                $evento = getEvento($_POST['idEvento']);
                $mensaje = "Imagen añadida con éxito.";
                echo $twig->render('./modificarEvento.html', ['evento'=>$evento, 'usuario' => $usuario, 'mensaje' => $mensaje]);
            }
            desconectaDeBaseDeDatos();
        }
      }
?>