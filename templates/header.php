<?php
require "./globals/database.php";
session_start();

$db = Database::getInstance();
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
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <style>
        input[type='number'] {
            -moz-appearance: textfield;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }
    </style>
</head>

<body>
    <header>
        <div class="container-fluid m-0 px-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-light px-2">
                <a class="navbar-brand" href="index.php"><img src="./img/logo.png" alt="logo"></a>
                <p class="m-0">Bienvenido <?= $_SESSION['user']['nombre']; ?></p>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Mi perfil</a>
                        </li>
                        <ul class="nav nav-list">
                            <li class="divider"></li>
                        </ul>

                        <?php if ($_SESSION['user']['acceso'] <= 1) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Mis cursos
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php
                                    $db->query("SELECT * FROM curso LEFT JOIN curso_p ON
                            curso.id_curso = curso_p.id_curso WHERE curso_p.id_persona = " .
                                        $_SESSION['user']['id']);
                                    $resp = $db->fetchAll(); //CADA CURSO SE CREA CON VALUE = id_curso 
                                    foreach ($resp as $temp) { ?>
                                        <form action="curso.php" method="POST">
                                            <button type="submit" class="dropdown-item">
                                                <?= $temp['nombre']; ?>
                                            </button>
                                            <input type="hidden" value="<?= $temp['id_curso']; ?>" name="curso" />
                                            <div class="dropdown-divider"></div>
                                        </form>
                                    <?php } ?>
                                    <!-- Cierre del foreach -->
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="consultas.php">Consultas</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="pwd.php">Cambiar contraseña</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Preguntas frecuentes
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="allcourses.php">Todos los cursos</a>
                            </li>
                        <?php }
                        if ($_SESSION['user']['acceso'] == 2) { ?>
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
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="pwd.php">Cambiar contraseñas</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="pendientes.php">Pendientes de pago</a>
                                </div>
                            </li><?php } ?>

                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <a href="logout.php" class="btn btn-sm btn-danger" type="button">Cerrar Sesion</a>
                    </form>
                </div>
            </nav>
        </div>
    </header>