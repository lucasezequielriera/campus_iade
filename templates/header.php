<?php
    session_start();
    require "globals\database.php";
    
    $db=Database::getInstance();
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
  <link rel="stylesheet" href="css/styles.css">  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Bienvenido <?=$_SESSION['user']['nombre'];?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">

      <?php if ($_SESSION['user']['acceso'] <=1) { ?>  
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="curso.php" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                <form action="curso.php" method="POST">
                  <button type="submit" class="dropdown-item">
                    <?=$temp['nombre'];?>
                  </button> 
                  <input type="hidden" value="<?=$temp['id_curso'];?>" name="curso">
                  <div class="dropdown-divider"></div>
                </form> <?php } ?>  <!-- Cierre del foreach -->
          </div>
        </li> 
          <li class="nav-item">
            <a class="nav-link" href="consultas.php">Consultas</a>
          </li>
      <?php } ?>

          <?php 
            if ($_SESSION['user']['acceso']==2) { ?>
               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu administrador
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="user.php">Alta/edicion de usuario</a>
                      <a class="dropdown-item" href="assign.php">Asignacion de curso</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="courses.php">Alta de curso</a>
                      <a class="dropdown-item" href="content.php">Modificacion de contenidos</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="exams.php">Alta/modificacion de examen</a>
                  </div>
               </li>  <?php } ?>
    </ul>
  </div>
  <a href="logout.php" class="btn btn-sm btn-danger" type="button">Cerrar Sesion</a>
</nav>