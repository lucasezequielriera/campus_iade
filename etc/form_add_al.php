<?php
require "../etc/database.php";

$db = Database::getInstance();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta de alumno</title>
</head>
<body>
    <form action="add_alumno" method="POST">
        <label for="dni">DNI</label><input name="dni" type="text">
        <label for="nombre">Nombre</label><input name="nombre" type="text">
        <label for="apellido">Apellido</label><input name="apellido" type="text">
        <select name="curso">
            <?php
                $db->query("SELECT * FROM curso"); 
                $resp = $db->fetchAll();
            foreach ($resp as $temp) {
                ?><option value="<?=$temp['id_curso']?>"><?=$temp['nombre'] ?></option>
                <?php }?>
        </select>
    </form>
</body>
</html>



