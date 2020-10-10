<?php
    require("conection.php");
   
    $sql = "SELECT MAX(id) AS max_val FROM articulos";

    if (!($resultado = $mysqli->query($sql)))
    {
        echo("Error");
        die();
    }

    $row = $resultado->fetch_assoc();
    echo $row['max_val'];

    $mysqli->close();

    ?>
