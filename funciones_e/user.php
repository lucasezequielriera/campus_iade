<?php
    require "../etc/database.php";

    $db = Database::getInstance();

    session_start();
    if (!isset($_SESSION['logged'])) {
        header("Location: login.php");
        exit;
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de usuario</title>
</head>
<body>
        <h1>Bienvenido <?php echo $_SESSION['user']['nombre'];?></h1>
        <h2>Mis cursos</h2><br>


        <?php  //BUSQUEDA DE CURSOS
            $db->query("SELECT curso.nombre 
                        FROM curso 
                        LEFT JOIN curso_p ON curso.id_curso = curso_p.id_curso
                        WHERE curso_p.id_persona = " . $_SESSION['user']['id']);

            $resp = $db->fetchAll();
            foreach ($resp as $temp) {
                //FALTA AGREGAR EL "BOTON" QUE LLEVE AL CONTENIDO DE CADA MATERIA.
                ?>  </br> <a href="<?=$temp['nombre'];?>">
                    <?=$temp['nombre'];?>
                    </a> 
            <?php
            }
        ?>

        <br><br>
        <a href="logout.php">Salir</a>
</body>
</html>