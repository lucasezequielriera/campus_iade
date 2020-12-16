<?php
require "./templates/header.php";
if (isset($_POST['form-videos'])) {
  file_put_contents($_POST['direccion'], $_POST['form-videos']);
}
if (isset($_FILES['file'])) {
  $fichero = $_FILES["file"];
  move_uploaded_file($fichero["tmp_name"], $_POST['dir_upload'] . $fichero["name"]);
}

if (isset($_POST['loadFile'])) {
  $fichero = $_FILES["file"];
  move_uploaded_file($fichero["tmp_name"], $_POST['dir_upload'] . $fichero["name"]);
}

if (isset($_POST['delete'])) {
  if ($_POST['delete'] != "./") unlink($_POST["delete"]);
}
?>

<div class="container m-0">
  <table class="table">
    <thead>
      <tr>
        <th>
          <h3><?= $_POST['directorio'] . " - " . $_POST['materia']; ?></h3>
        </th>
      </tr>
      <tr>
        <th width="80%">Nombre del Archivo</th>
        <th width="10%">Descargar</th>
        <th width="10%" class="text-right">Eliminar</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $archivos = scandir($_POST['raiz'] . $_POST['directorio']);
      $curso = $_POST['raiz'] . $_POST['directorio'] . "/";
      for ($i = 2; $i < count($archivos); $i++) {
        if ($archivos[$i] == "videos.txt") continue; ?>
        <tr>
          <td class="text-left">
            <?= $archivos[$i]; ?>
          </td>

          <td class="text-center"><a title="Descargar Archivo" href="" download="<?= $archivos[$i]; ?>" style="color: blue; font-size:18px;"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
              </svg></a></td>

          <td class="text-center">
            <form action="" method="post">
              <input type="hidden" name="delete" value="<?=$curso.$archivos[$i];?>">
              <button style="color: red; font-size:18px;" onclick="return confirm('Esta seguro de eliminar el archivo?');">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                </svg>
              </button>
              <input type="hidden" name="raiz" value="<?= $_POST['raiz']; ?>">
              <input type="hidden" name="materia" value="<?= $_POST['materia']; ?>">
              <input type="hidden" name="directorio" value="<?= $_POST['directorio']; ?>">
              <input type="hidden" name="direccion" value="<?= $curso . "/videos.txt"; ?>">
            </form>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <!-- uploader -->
  <div class="row mt-2 ml-1">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Cargar Ficheros</h3>
      </div>
      <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
          <label class="btn btn-info" for="my-file-selector">
            <input type="file" name="file" id="exampleInputFile">
            <input type="hidden" value="<?= $curso ?>" name="dir_upload">
          </label>
          <input type="hidden" name="raiz" value="<?= $_POST['raiz']; ?>">
          <input type="hidden" name="materia" value="<?= $_POST['materia']; ?>">
          <input type="hidden" name="directorio" value="<?= $_POST['directorio']; ?>">
          <input type="hidden" name="direccion" value="<?= $curso . "/videos.txt"; ?>">
          <button class="btn btn-warning ml-2" name="loadFile" type="submit">Cargar Fichero</button>
        </div>
      </form>
    </div>
  </div>

  <div class="row ml-2">
    <form action="" method="post">
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Videos:</label>
        <textarea class="form-control" name="form-videos" rows="8" cols="100">
        <?php
        $handle = fopen($curso . "/videos.txt", "r");
        if ($handle) {
          while (($line = fgets($handle)) !== false) {
            echo ltrim($line);
          }
          fclose($handle);
        } else {
          echo "error al cargar el archivo de videos.";
        }
        ?>
    </textarea>
        <input type="hidden" name="raiz" value="<?= $_POST['raiz']; ?>">
        <input type="hidden" name="materia" value="<?= $_POST['materia']; ?>">
        <input type="hidden" name="directorio" value="<?= $_POST['directorio']; ?>">
        <input type="hidden" name="direccion" value="<?= $curso . "/videos.txt"; ?>">
        <input type="hidden" name="course" value="<?=$_POST['course'];?>">
        <button class="mt-2 btn btn-success" type="submit">Guardar</button>
    </form>
  </div>
</div>
<div class="row ml-1">
  <form action="content.php" method="post">
    <input type="hidden" name="course" value="<?=$_POST['course'];?>">
    <button class="btn btn-danger ml-2">Volver a modulos</button>
  </form>
  </div>

<?php
require "./templates/footer.php";
?>