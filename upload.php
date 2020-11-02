<?php
$fichero = $_FILES["file"];
move_uploaded_file($fichero["tmp_name"], $_POST['dir_upload'] . $fichero["name"]);
header("Location: " . $_SERVER["HTTP_REFERER"]);
?>