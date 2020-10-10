<?php
    require ("conection.php");

      $cod = $_POST['cod'];
      $description= $_POST['description'];
      $stock= $_POST['stock'];
      $tipo= $_POST['tipo'];
      $um = $_POST['um'];

      $sentencia = $mysqli->prepare("UPDATE articulos SET tipo=?,um=?,description=?,stock=? WHERE id=?");
      $sentencia->bind_param('sssii', $tipo,$um,$description,$stock,$cod);
      $sentencia->execute();
      mysqli_close($mysqli);
?>