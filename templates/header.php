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
  <a class="navbar-brand" href="index.php">Bienvenido <?=$_SESSION['user']['nombre'];?> </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="cursos.php" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mis examenes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a href="" class="dropdown-item">Examenes</a>
            <a href="" class="dropdown-item">Certificados</a>
        </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="chat.php">Consultas</a>
      </li>
    </ul>
  </div>
  <a href="logout.php" class="btn btn-sm btn-outline-secondary" type="button">Logout</a>
</nav>