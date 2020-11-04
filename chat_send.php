<?php 
require "./globals/database.php";
$db = Database::getInstance();

$message = isset($_POST['message']) ? $db->escapeWildcards($db->escape($_POST['message'])) : null;
$from = isset($_POST['from']) ? $_POST['from'] : null;  //from seria id_persona
$course = isset($_POST['course']) ? $_POST['course'] : null;
$check = $_POST['acc'];
$ii = $_POST['ii'];

if ($check == 1) {
    $db->query("INSERT INTO `chat` (`id_chat`, `id_curso`, `id_persona`, `mensaje`, `fecha`) 
                VALUES ('$ii', '$course', '$from', '$message', current_timestamp());");
}

else {
$db->query("INSERT INTO `chat` (`id_chat`, `id_curso`, `id_persona`, `mensaje`, `fecha`) 
            VALUES ('$from', '$course', '$from', '$message', current_timestamp());");
}
?>