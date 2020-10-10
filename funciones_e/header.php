<?php
    require "../etc/database.php";

    $db = Database::getInstance();
    session_start();
    if (!isset($_SESSION['logged'])) {
        header("Location: login.php");
        exit;
    }
?>

<!doctype html>
<html lang="en">
  <head>
      <?php 
        require "../etc/imports.php";
      ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Campus IADE</title>
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Bienvenido <?=$_SESSION['user']['nombre'];?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Mis cursos
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

    <?php
        $db->query("SELECT * 
                  FROM curso 
                  LEFT JOIN curso_p ON curso.id_curso = curso_p.id_curso
                  WHERE curso_p.id_persona = " . $_SESSION['user']['id']);
        $resp = $db->fetchAll(); 
      //Armado de los links con nombre de materia y value de la misma (curso_id)
    foreach ($resp as $temp) { ?>
            <button class="dropdown-item" onclick="class_render(<?=$temp['id_curso'];?>)">
                <?=$temp['nombre'];?>
            </button>  
          <?php } ?>

            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Consultas</a>
          </li>

        </ul>
        <form class="form-inline my-2 my-lg-0">
          <a href="logout.php"><button class="btn btn-outline-success my-2 my-sm-0" type="button">Cerrar sesion</button></a>
        </form>
      </div>
    </nav>
