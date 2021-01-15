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

<div class="col-10 mt-3 offset-1 offset-md-0 col-md-3 col-lg-4">
  <div class="card">
    <img class="card-img-top" src="<?= $curso['imagen'] ?>" title="<?= $curso['nombre'] ?>" alt="titulo" data-toggle="popover" ; data-trigger="hover" ; data-content="<?= $curso['descripcion'] ?>" ; height="250px" ;>
    <div class="card-body">
      <h1><?= $curso['nombre'] ?></h1>

      <div class="panel panel-primary">
        <div class="panel-heading">
          <h4 class="panel-title">Material de estudio</h4>
        </div>
        <div class="panel-body">
          <table class="table">
            <thead>
              <tr>
                <th width="70%">Nombre del Archivo</th>
                <th width="13%">Descargar</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $userId = $db->escape($_SESSION['user']['id']);
              $db->query("SELECT nivel, pago, nota
                                  FROM curso_p 
                                  LEFT JOIN personas ON curso_p.id_persona = $userId
                                  WHERE curso_p.id_curso = $cursoId
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
                      <button class="btn btn-info"><?= $archivos[$i]; ?></button>
                    </form>
                  </td>
                  <td class="text-center">
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
          <tr>
            <?php
            if ($curso_p['pago'] == 1 && $curso_p['nota'] < 6) { ?>
              <form action="quiz.php" method="post">
                <button type="submit" class="card-text btn btn-danger">
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
          </tr>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require "./templates/footer.php";
?>