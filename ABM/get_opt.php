<?php
    require ("conection.php");
    $sql = "SELECT * FROM valores_tipo";
    if (!($result = $mysqli->query($sql))) {
        echo("Error");
        die();
    }

    $tipos=[];
    while($fila=$result->fetch_assoc()) {
        $objeto=$fila['tipos'];
        array_push($tipos, $objeto);
    }

    $jsonVar = json_encode($tipos);
    $mysqli->close();
    echo $jsonVar;
?>