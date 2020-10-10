<?php

include ("conection.php");

        $cod = $_POST['cod'];
        $description= $_POST['description'];
        $stock= $_POST['stock'];
        $tipo= $_POST['tipo'];
        $date= $_POST['fecha'];
        $um = $_POST['um'];

        $sentencia = $mysqli->prepare("INSERT INTO 
        articulos (id, tipo, um, description, fecha, stock)
        VALUES ('$cod', '$tipo', '$um', '$description', '$date', '$stock')");

        $sentencia->execute();
        mysqli_close($mysqli);
?>

