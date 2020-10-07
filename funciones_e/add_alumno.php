<?php
require "../etc/database.php";

if ($_POST>0) {

    $dni = $_POST['dni'];
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];

    $db->query("INSERT INTO `personas` 
                (`id`, `dni`, `password`, `nombre`, `apellido`, `acceso`)               
                VALUES (NULL, $dni, $dni, $nombre, $apellido, '0')");
}

?>