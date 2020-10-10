<?php
    require("conection.php");
    $orden_c = $_POST['entrada'];   

    $f_tipo  = $_POST['tipo'];
    $f_um = $_POST['um'];
    $f_description = $_POST['description'];
    $f_fecha = $_POST['fecha'];
    $f_stock = $_POST['stock'];

    $sql = "SELECT * FROM articulos WHERE ";
    $sql = $sql . "tipo LIKE '%" . $f_tipo . "%' AND ";

    
    $sql = $sql. "um LIKE '%" . $f_um . "%' AND ";
    $sql = $sql. "description LIKE '%" . $f_description . "%' AND ";
    $sql = $sql. "fecha LIKE '%" . $f_fecha . "%' AND ";
    $sql = $sql. "stock LIKE '%" . $f_stock . "%' ";
    $sql = $sql. "ORDER BY ".$orden_c ;

    if (!($resultado = $mysqli->query($sql))){
        echo("Error");
        die();
    }

    $articulos=[];
    while($fila=$resultado->fetch_assoc()) {
        $objeto = new stdClass();
        $objeto->id=$fila['id'];
        $objeto->tipo=$fila['tipo'];
        $objeto->um=$fila['um'];
        $objeto->description=$fila['description'];
        $objeto->fecha=$fila['fecha'];
        $objeto->stock=$fila['stock'];

        array_push($articulos, $objeto);
    }

    $objArticulos = new stdClass();
    $objArticulos->articulos = $articulos;
    $objArticulos->cantidad = $resultado->num_rows;
    $jsonOut = json_encode($objArticulos);
    $mysqli->close();

    echo $jsonOut;
?>