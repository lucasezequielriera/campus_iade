<?php
    require "../etc/database.php";

    session_start();

    if (count($_POST) > 0) {
        $db = Database::getInstance();
        $dni = $db->escape($_POST['dni']);
        $dni = $db->escapeWildcards($_POST['dni']);
        $pwd = $db->escape($_POST['password']);
        $pwd = $db->escapeWildcards($_POST['password']);
        $pwd = sha1($pwd);
     
        $db->query("SELECT * 
                        FROM personas 
                        WHERE dni = '$dni' AND password = '$pwd'
                        LIMIT 1");

        if ($db->numRows() == 1) {
            $_SESSION['logged'] = true;
            $_SESSION['user'] = $db->fetch();
            header("Location: user.php");
            exit;
        }
    }
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de login</title>
</head>
<body>

    <h1>IADE login</h1>
    <form action="" method="POST">
        <input type="text" name="dni" placeholder="Ingrese documento" required>
        <input type="password" name="password" placeholder="Ingrese contraseña" required>
        <input type="submit" value="Entrar">
    </form>

    <h1><a href="#">Recuperar contraseña</a></h1>
    <a href="logout.php">logout temporal, tsting</a>
</body>
</html>