<?php
    require "globals/database.php";

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
  <title>IADE Campus</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Bienvenido <?=$_SESSION['user']['nombre'];?> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mis cursos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

        <?php 
        $db->query("SELECT * 
                    FROM curso 
                    LEFT JOIN curso_p ON curso.id_curso = curso_p.id_curso
                    WHERE curso_p.id_persona = " . $_SESSION['user']['id']);
        $resp = $db->fetchAll(); 
        //CADA CURSO SE CREA CON VALUE = id_curso
        foreach ($resp as $temp) { ?>
          <button class="dropdown-item" value="<?=$temp['id_curso'];?>">
            <?=$temp['nombre'];?>
          </button> <?php } ?>
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="chat.php">Consultas</a>
      </li>
    </ul>
  </div>
</nav>