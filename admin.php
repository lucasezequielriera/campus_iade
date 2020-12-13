<?php
require "./templates/header.php";

if (isset($_POST['btnAccion'])) {
    switch ($_POST['btnAccion']) {
        
        case 'newCourse':
            $categoria = $_POST['categoria'];
            $nombre = $_POST['nombre'];
            $descripcion_curso = $_POST['descripcion_curso'];
            $directoryName = './cursos/' . $nombre;
            $examDirectory = $directoryName . '/' . 'exams/';
            $target_dir = $directoryName . '/';
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check por si es un archivo valido (>0)
            $check = getimagesize($_FILES["file"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
            //hacer el check por si no es imagen.
            if (file_exists($target_file)) {
                $err = "Error, ya existe un archivo con ese nombre";
                $uploadOk = 0;
            }

            if ($_FILES["file"]["size"] > 512000) {  // MAX 500Kb
                $err = "Error, el archivo supera los 500kb";
                $uploadOk = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $err = "Error, solo archivos JPG, JPEG o PNG son aceptados.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                $_SESSION['mensaje'] = $err;
                $_SESSION['msg_status'] = 0;                              //Si hubo error se redirige a courses.php
                header("Location: courses.php");
                exit();
            } else {
                //creacion del directorio del curso
                if (!is_dir($directoryName)) {
                    mkdir($directoryName, 0777);
                    for ($i = 0; $i < 6; $i++) {
                        $directoryName = 'cursos/' . $nombre . '/Modulo ' . ($i + 1);
                        mkdir($directoryName, 0777);
                    }
                    $dir_exam = $target_dir . "/exams";
                    mkdir($dir_exam,0777);

                }
                //volcado de la informacion a la base de datos //carga de la imagen en directorio del curso
                if (move_uploaded_file($_FILES["file"]["tmp_name"],$target_file)) {
                    $nombre = $_POST['nombre'];
                    $db->query("INSERT INTO `curso`(`nombre`, `url_doc`, `imagen`, `descripcion`, `exams`, `categoria`)
                                VALUES ('$nombre','$target_dir', '$target_file', '$descripcion_curso','$examDirectory' , '$categoria')");
                    $_SESSION['mensaje'] = "Se ha creado con exito el curso " . $nombre;
                    $_SESSION['msg_status'] = 1;
                    header("Location: courses.php");
                    exit();
                } else {
                    $_SESSION['mensaje'] = ("Hubo un error al subir el archivo: " . $err);
                    $_SESSION['msg_status'] = 0;
                    header("Location: courses.php");
                    exit();
                }
            }
            break;

        case 'courseAssign':
            $nombre = $_POST['id_persona']; //id_persona
            $course = $_POST['course']; //id curso
            $pago1 = (isset($_POST['pago']) ? $_POST['pago'] : 0);
            $cond = 6;
            $db->query("INSERT INTO curso_p (`id_curso`, `id_persona`, `nivel`, `pago` ) 
                            VALUES ('$course','$nombre', '$cond', '$pago1');");
            $_SESSION['mensaje'] = "Curso asignado!";
            $_SESSION['msg_status'] = 1;
            header("Location: assign.php");
            exit();
            break;
    }
}