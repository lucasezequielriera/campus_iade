<?php
$fichero = $_FILES["file"];
move_uploaded_file($fichero["tmp_name"], "uploads/".$fichero["name"]);
header("Location: " . $_SERVER["HTTP_REFERER"]);
?>