<?php
session_start();
require "globals/database.php";
$db = Database::getInstance();

        $temp = $_GET['dni'];
        $db->query("SELECT * FROM `personas` WHERE dni='$temp'");
        $data = $db->fetch();
        echo json_encode($data); 
?>