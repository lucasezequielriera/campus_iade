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
        <h2>Mis cursos</h2>

        <?php $db->query("SELECT curso.nombre 
                        FROM curso 
                        LEFT JOIN curso_p ON curso.id_curso = curso_p.id_curso
                        WHERE curso_p.id_persona = " . $_SESSION['user']['id']);
            $resp = $db->fetchAll();?> 

        <table>
            <tbody>
        <?php foreach ($resp as $temp) {
                ?>
                <tr>
                    <td>
                        <a href="../cursos/<?=$temp['nombre'];?>/"><?=$temp['nombre'];?> 
                    </td>
                </tr>
                    <?php
                }?>

        </tbody>
            </table>

            <?php


function listarArchivos( ){

    $path = "../cursos/Matematica/";
    // Abrimos la carpeta que nos pasan como parámetro
    $dir = opendir($path);
    // Leo todos los ficheros de la carpeta
    while ($elemento = readdir($dir)){
        // Tratamos los elementos . y .. que tienen todas las carpetas
        if( $elemento != "." && $elemento != ".."){
            // Si es una carpeta
            if( is_dir($path.$elemento) ){
                // Muestro la carpeta
                echo "<a href='$path$elemento'>$elemento</a><br>";
            // Si es un fichero
            } else {
                // Muestro el fichero
                echo "<br />". $elemento;
            }
        }
    }
}
// Llamamos a la función para que nos muestre el contenido de la carpeta gallery
listarArchivos();

?>

</body>
</html>