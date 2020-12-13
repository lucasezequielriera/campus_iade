<?php
if ($_GET['name']== "./") {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
} else {
    unlink($_GET["name"]);
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
}
?>