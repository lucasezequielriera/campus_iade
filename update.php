<?php
require "./globals/database.php";
$db = Database::getInstance();

        $nombre = $db->escapeWildcards($db->escape($_POST['nombre']));
        $apellido = $db->escapeWildcards($db->escape($_POST['apellido']));
        $telefono = $db->escapeWildcards($db->escape($_POST['tel']));
        $email = $db->escapeWildcards($db->escape($_POST['mail']));
        $type = $db->escapeWildcards($db->escape($_POST['type']));
        $dni = $db->escapeWildcards($db->escape($_POST['dni']));
        
        $db->query("UPDATE personas SET 
                                nombre='$nombre',
                                apellido='$apellido',
                                acceso='$type',
                                telefono='$telefono',
                                email='$email'
                                WHERE dni='$dni' 
                                LIMIT 1");
        $_SESSION['msg_status'] = 1;
?>