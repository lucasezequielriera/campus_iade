<?php
require "./templates/header.php";

$cursoId = $db->escape($_POST['curso']);
$db->query("SELECT * 
                FROM curso 
                WHERE id_curso = $cursoId 
                LIMIT 1");
$curso = $db->fetch();

$_SESSION['course_name_exam'] = $curso['nombre'];
$_SESSION['courseId'] = $cursoId;
?>

<div class="container-fluid mycourses">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="course">
          <h1><?= $curso['nombre'] ?></h1>
          <img class="card-img-top" src="<?= $curso['imagen'] ?>" title="<?= $curso['nombre'] ?>" alt="titulo" data-toggle="popover" ; data-trigger="hover" ; data-content="<?= $curso['descripcion'] ?>" ; height="250px" ;>
        </div>
        <div class="card-body">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"><u>Material de estudio</u></h3>
            </div>
            <div class="panel-body">
              <table class="table" style="border:2px solid grey; margin-top: 20px">
                <thead>
                  <tr>
                    <th width="30%" style="border:2px solid grey">Nombre del Archivo</th>
                    <th class="text-center" width="10%" style="border:2px solid grey">Descargar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $userId = $_SESSION['user']['id'];
                  $db->query("SELECT nivel, pago, nota
                                      FROM curso_p 
                                      LEFT JOIN personas ON curso_p.id_persona = $userId
                                      WHERE curso_p.id_curso = '$cursoId'
                                      LIMIT 1");
                  $curso_p = $db->fetch();
                  $nivelUsuario = ($curso_p['nivel']);
                  $archivos = scandir($curso['url_doc']);
                  for ($i = 2; $i < $nivelUsuario + 2; $i++) { ?>
                    <tr>
                      <td>
                        <form action="./course_content.php" method="post">
                          <input type="hidden" value="<?= $curso['url_doc'] . $archivos[$i]; ?>" name="module">
                          <input type="hidden" name="curso" value="<?= $cursoId; ?>">
                          <button class="btn btn-info" width="300px"><?= $archivos[$i]; ?></button>
                        </form>
                      </td>
                      <td class="text-center" style="border-left-style: solid; border-left-width: 2px; border-left-color: grey">
                        <form action="./zipdownload.php" method="post">
                          <input type="hidden" value="<?= $curso['url_doc'] . $archivos[$i]; ?>" name="course_folder">
                          <input type="hidden" value="<?= $archivos[$i]; ?>" name="module_number">
                          <input type="hidden" value="<?= $curso['nombre']; ?>" name="course_name">
                          <input type="image" src="./img/download.svg">
                        </form>
                      </td>
                    </tr>
                  <?php
                  } ?>
                </tbody>
              </table>
              <div class="optionalbuttons">
                <?php
                if ($curso_p['pago'] == 1 && $curso_p['nota'] < 6) { ?>
                  <form action="quiz.php" method="post">
                    <button type="submit" class="card-text btn btn-success">
                      Rendir examen final
                    </button>
                    <input type="hidden" value="<?= $_SESSION['course_name_exam']; ?>" name="courseName">
                    <input type="hidden" value="<?= $_SESSION['courseId']; ?>" name="courseName">
                  </form>
                <?php }
                if ($curso_p['pago'] == 1 && $curso_p['nota'] >= 6) { ?>
                  <form action="certificate.php" method="post">
                    <button type="submit" class="card-text btn btn-warning">
                      Descargar certificado del curso
                    </button>
                    <input type="hidden" value="<?= $curso['exams']; ?>" name="examen">
                  </form>
                <?php } ?>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="footercontentmycourses">
<?php
require "./templates/footer.php";
?>
</div>