<?php 
include "globals/database.php";

$db = Database::getInstance();

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
                $url_doc = "cursos/" . $_POST['url_doc'];
                $nombre = $_POST['nombre'];
                $img = "borrar";
                $db->query("INSERT INTO `curso`(`nombre`, `url_doc`, `imagen`) 
                            VALUES ('$nombre','$url_doc', '$img');");
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