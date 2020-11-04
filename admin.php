<?php
require "./templates/header.php";

if (isset($_POST['btnAccion'])) {
    switch ($_POST['btnAccion']) {
        case 'password_change':
            $user_id = $_SESSION['user']['id']; 
            $pwd_1 = $_POST['pwd_1'];
            $pwd_2 = $_POST['pwd_2'];
            $db->query("SELECT `password` FROM personas WHERE id = '$user_id' LIMIT 1");
            $pwd_db = $db->fetch();

            if ($_SESSION['user']['acceso'] == 2) {
                $pwd_actual = $pwd_db['password'];
                $temp_dni = $_POST['dni'];
                $db->query("SELECT `id` FROM personas WHERE dni = '$temp_dni' LIMIT 1");
                $temp_dni = $db->fetch();
                $user_id = $temp_dni['id'];
            }else {
                $pwd_actual = sha1($_POST['pwd_actual']);
            }
            
            if (strlen($pwd_1) < 5) {
                $_SESSION['mensaje'] = "La contraseña debe contener almenos 5 caracteres.";
                $_SESSION['msg_status'] = 0;
                header("Location: pwd.php");
            } else {
                if ($pwd_actual == $pwd_db['password']) {
                    if ($pwd_1 !== $pwd_2) {
                        $_SESSION['mensaje'] = "Las contraseñas ingresadas no coinciden.";
                        $_SESSION['msg_status'] = 0;
                        header("Location: pwd.php");
                    } else {
                        $pwd_2 = sha1($pwd_1);
                        $db->query("UPDATE personas SET `password` = '$pwd_2'
                                WHERE id = '$user_id';");
                        $_SESSION['mensaje'] = "Contraseña cambiada con exito!";
                        $_SESSION['msg_status'] = 1;
                        header("Location: pwd.php");
                    }
                } else {
                    $_SESSION['mensaje'] = "La contraseña es incorrecta.";
                    $_SESSION['msg_status'] = 0;
                    header("Location: pwd.php");
                }
            }
            break;

        case 'newUser':
            $nombre1 = $_POST['nombre'];
            $apellido1 = $_POST['apellido'];
            $dni1 = $_POST['dni'];
            $pwd1 = sha1($dni1);
            $acceso = $_POST['userAccess'];
            $telefono1 = $_POST['tel'];
            $email1 = $_POST['mail'];
            $db->query("SELECT * FROM personas WHERE id = '$dni1'");
            $temp = $db->fetch();
            if ($temp == NULL) {
                $_SESSION['mensaje'] = "El usuario ya existe.";
                $_SESSION['msg_status'] = 0;
                header("Location: user.php");
            }

            $db->query("INSERT INTO personas(`dni`, `password`, `nombre`, `apellido`, `acceso`, `telefono`, `email`) 
                        VALUES ('$dni1', '$pwd1', '$nombre1', '$apellido1', '$acceso', '$telefono1', '$email1');");
            $_SESSION['mensaje'] = "Usuario creado!";
            $_SESSION['msg_status'] = 1;
            header("Location: user.php");
            break;

        case 'newCourse':
            $nombre = $_POST['nombre'];
            $directoryName = './cursos/' . $nombre;
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
                    $db->query("INSERT INTO `curso`(`nombre`, `url_doc`, `imagen`)
                                VALUES ('$nombre','$target_dir', '$target_file')");
                    $_SESSION['mensaje'] = "Se ha creado con exito el curso " . $nombre;
                    $_SESSION['msg_status'] = 1;
                    header("Location: courses.php");
                } else {
                    $_SESSION['mensaje'] = ("Hubo un error al subir el archivo: " . $err);
                    $_SESSION['msg_status'] = 0;
                    header("Location: courses.php");
                }
            }
            break;

        case 'courseAssign':
            $nombre = $_POST['id_persona']; //id_persona
            $course = $_POST['course']; //id curso
            $pago1 = (isset($_POST['pago']) ? $_POST['pago'] : 0);
            $cond = 1;
            if (isset($_POST['cond_libre'])) $cond = 6;
            $db->query("INSERT INTO curso_p (`id_curso`, `id_persona`, `nivel`, `pago` ) 
                            VALUES ('$course','$nombre', '$cond', '$pago1');");
            $_SESSION['mensaje'] = "Curso asignado!";
            $_SESSION['msg_status'] = 1;
            header("Location: assign.php");
            break;
    }
}