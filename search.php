<?php
require "./globals/database.php";
$db = Database::getInstance();
        $temp = $db->escape($_GET['dni']);
        $db->query("SELECT * FROM `personas` WHERE dni='$temp'");
        $data = $db->fetch();
        echo json_encode($data); 
?>