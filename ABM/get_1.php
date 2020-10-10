<?php
    require ("conection.php");

    $id = $_POST['entrada'];
    $sql = "SELECT * FROM articulos WHERE id='$id'";

    if (!($resultado = $mysqli->query($sql)))
    {
        echo("Error");
        die();
    }

        $fila = $resultado->fetch_assoc();
        $objeto = new stdClass();

        $objeto->codArt=$fila['id'];
        $objeto->tipo=$fila['tipo'];
        $objeto->um=$fila['um'];
        $objeto->description=$fila['description'];
        $objeto->fecha_alta=$fila['fecha'];
        $objeto->stock=$fila['stock'];

    $jsonOut = json_encode($objeto);
    $mysqli->close();

    echo $jsonOut;


?>