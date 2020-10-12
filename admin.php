<?php 

$nombre1 = $_POST['nombre'];
$apellido1 = $_POST['apellido'];
$dni1 = $_POST['dni'];
$pwd1 = sha1($dni1);
$acceso = $_POST['userAccess'];
$telefono1 = $_POST['tel'];
$email1 = $_POST['mail'];

//FALTA DEPURAR 
//CHEQUEAR QUE SE EJECUTA COMO SI SIEMPRE ESTUVIEES PRESIONADO EL BOTON. REVISAR

if (isset($_POST['btnAccion'])){
    switch ($_POST['btnAccion']) {
        case 'newUser' : 
            $db->query("INSERT INTO `personas`(`dni`, `password`, `nombre`, `apellido`, `acceso`, `telefono`, `email`) 
                        VALUES ('$dni1', '$pwd1', '$nombre1', '$apellido1', '$acceso', '$telefono1', '$email1');");
        break;
    }
}



?>