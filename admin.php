<?php 
$mensaje ="";

if (isset($_POST['btnAccion'])){
    switch ($_POST['btnAccion']) {
        case 'newUser' : 
            $nombre1 = $_POST['nombre'];
            $apellido1 = $_POST['apellido'];
            $dni1 = $_POST['dni'];
            $pwd1 = sha1($dni1);
            $acceso = $_POST['userAccess'];
            $telefono1 = $_POST['tel'];
            $email1 = $_POST['mail'];
            $db->query("INSERT INTO `personas`(`dni`, `password`, `nombre`, `apellido`, `acceso`, `telefono`, `email`) 
                        VALUES ('$dni1', '$pwd1', '$nombre1', '$apellido1', '$acceso', '$telefono1', '$email1');");
            break;

        case 'newCourse' : 
            $nombre = $_POST['nombre'];
            $directoryName = 'cursos/' . $nombre;
            $target_dir = $directoryName . '/';
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Check por si es un archivo valido (>0)
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
            //hacer el check por si no es imagen.
            if (file_exists($target_file)) {
                $err = "Ya existe un archivo con ese nombre";
                $uploadOk = 0;
                }

            if ($_FILES["file"]["size"] > 512000) {  // MAX 500Kb
                $err = "Error, el archivo supera los 500kb";
                $uploadOk = 0;
            }

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $err = "Solo archivos JPG, JPEG o PNG son aceptados."; 
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {  //Si hubo error se redirige a courses.php
                header("Location: courses.php");
            } else {
                    //creacion del directorio del curso
                if(!is_dir($directoryName)){
                    mkdir($directoryName, 0777);
                    for ($i=0; $i<6 ; $i++) {
                        $directoryName = 'cursos/' . $nombre . '/Modulo ' . ($i+1);
                        mkdir($directoryName, 0777);
                    }
                }
                                                                                         //carga de la imagen en directorio del curso
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {        //volcado de la informacion a la base de datos                                          
                    $nombre = $_POST['nombre'];
                    $url_doc = "cursos/" . $nombre;
                    $db->query("INSERT INTO `curso`(`nombre`, `url_doc`, `imagen`) 
                                VALUES ('$nombre','$url_doc', '$target_file');");
                    $mensaje = "El archivo ". htmlspecialchars( basename( $_FILES["file"]["name"])). " se ha subido con exito.";
                    header("Location: courses.php");
                } 
                else {
                    $mensaje = "Hubo un error al subir el archivo " . $err;
                    header("Location: courses.php");
                    }
                }
            break;

        case 'courseAssign' :
                $nombre = $_POST['id_persona']; //id_persona
                $course = $_POST['course']; //id curso
                $cond = 0;
                if (isset($_POST['cond_libre'])) $cond = 6;
                $db->query("INSERT INTO `curso_p`(`id_curso`, `id_persona`, `nivel`) 
                            VALUES ('$course','$nombre', '$cond');");
            break;           
    }
}
?>