<?php 
require "./globals/database.php";
$db = Database::getInstance();
if ($_SESSION['user']['acceso'] == 1) exit;


$message = isset($_POST['message']) ? $db->escape($_POST['message']) : null;
$from = isset($_POST['from']) ? $db->escape($_POST['from']) : null;  //from seria id_persona
$course = isset($_POST['course']) ? $db->escape($_POST['course']) : null;
$check = $db->escape($_POST['acc']);
$ii = $db->escape($_POST['ii']);

if ($check == 1) {
    $db->query("INSERT INTO `chat` (`id_chat`, `id_curso`, `id_persona`, `mensaje`, `fecha`) 
                VALUES ('$ii', '$course', '$from', '$message', current_timestamp());");
}

else {
$db->query("INSERT INTO `chat` (`id_chat`, `id_curso`, `id_persona`, `mensaje`, `fecha`) 
            VALUES ('$from', '$course', '$from', '$message', current_timestamp());");
}
?>