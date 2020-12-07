<?php
require "./templates/header.php";

$cursoId = $_POST['curso'];
$db->query("SELECT * 
                FROM curso 
                WHERE id_curso = $cursoId 
                LIMIT 1");
$curso = $db->fetch();
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
              $userId = $_SESSION['user']['id'];
              $db->query("SELECT nivel 
                                  FROM curso_p 
                                  LEFT JOIN personas ON curso_p.id_persona = $userId
                                  WHERE curso_p.id_curso = $cursoId
                                  LIMIT 1");
              $nivelUsuario = $db->fetch();

              $nivelUsuario = ($nivelUsuario['nivel']);
              $archivos = scandir($curso['url_doc']);
              for ($i = 2; $i < $nivelUsuario + 2; $i++) { ?>
                <tr>
                  <td><a href=""><?php echo $archivos[$i]; ?></a></td>
                  <td><a title="Descargar Archivo" href="<?= $curso['url_doc'] . $archivos[$i]; ?>" download="<?php echo $archivos[$i]; ?>" style="color: blue; font-size:18px;"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                        <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                      </svg></a></td>
                </tr>               
              <?php
             } ?>



            </tbody>
          </table>
        </div>
      </div>
      <form action="quiz_selector.php" method="post">
        <button type="submit" class="card-text btn btn-info">
          Rendir Final
          <input type="hidden" value="<?= $curso['url_doc']; ?>" name="materia">
        </button>
      </form>
    </div>
  </div>
</div>

<?php
require "./templates/footer.php";
?>