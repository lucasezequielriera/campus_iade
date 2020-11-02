<?php
require "globals/database.php";
$db = Database::getInstance();
    $var = $db->escapeWildcards($db->escape($_POST['id']));
    $db->query("UPDATE `curso_p` SET pago = 1 WHERE dni = '$var'" LIMIT 1);
?>