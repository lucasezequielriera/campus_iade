<?php
    require "../etc/database.php";

    $db = Database::getInstance();

    session_start();
    if (!isset($_SESSION['logged'])) {
        header("Location: login.php");
        exit;
    }
?>