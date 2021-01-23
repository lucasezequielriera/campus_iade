<?php
require "./templates/header.php";
if ($_SESSION['user']['acceso'] != 0) exit;

if (isset($_POST['newCourse'])) {
  $cantidadModulos = $db->escape($_POST['cantidadModulos']);
  $categoria = $db->escape($_POST['categoria']);
  $nombre = $db->escape($_POST['nombre']);
  $descripcion_curso = $db->escape($_POST['descripcion_curso']);
  $directoryName = './cursos/' . $nombre;
  $examDirectory = $directoryName . '/' . 'exams/';
  $target_dir = $directoryName . '/';
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $target_name = $target_dir . $nombre . "." . $imageFileType;

  //check si el curso ya existe
  $db->query("SELECT `nombre` FROM `curso` WHERE `nombre` = '$nombre' LIMIT 1");
  if ($db->numRows() == 1) {
    $err = "Error, ya existe un curso con ese nombre";
    $uploadOk = 0;
  } else {
    // Check por si es un archivo valido (>0)
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
      $uploadOk = 1;
    } else {
      $uploadOk = 0;
    }

    if ($_FILES["file"]["size"] > 512000) {  // MAX 500Kb
      $err = "Error, el archivo supera los 500kb";
      $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
      $err = "Error, solo archivos JPG, JPEG o PNG son aceptados.";
      $uploadOk = 0;
    }
  }

  if ($uploadOk == 0) {
    $_SESSION['mensaje'] = $err;
    $_SESSION['msg_status'] = 0;
  } else {
    //creacion del directorio del curso
    if (!is_dir($directoryName)) {
      mkdir($directoryName, 0777);
      for ($i = 0; $i < $cantidadModulos; $i++) {
        $directoryName = 'cursos/' . $nombre . '/Modulo ' . ($i + 1);
        mkdir($directoryName, 0777);
        $myfile = fopen($directoryName."/videos.txt", "w");
        fwrite($myfile, "Primera linea -->link del video\nSegunda linea --> descripcion del video\nNo dejar espacios al final de cada linea.\nEliminar COMPLETAMENTE este texto antes de cargar informacion.");
        fclose($myfile);
      }
      $dir_exam = $target_dir . "exams";
      mkdir($dir_exam, 0777);
    }
    //volcado de la informacion a la base de datos //carga de la imagen en directorio del curso
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_name)) {
      $nombre = $_POST['nombre'];
      $db->query("INSERT INTO `curso`(`nombre`, `url_doc`, `imagen`, `descripcion`, `exams`, `categoria`, `cantidad_modulos` )
                          VALUES ('$nombre','$target_dir', '$target_name', '$descripcion_curso','$examDirectory' , '$categoria', '$cantidadModulos')");
      $_SESSION['mensaje'] = "Se ha creado con exito el curso " . $nombre;
      $_SESSION['msg_status'] = 1;
    } else {
      $_SESSION['mensaje'] = ("Hubo un error al subir el archivo: " . $err);
      $_SESSION['msg_status'] = 0;
    }
  }
}

if ($_SESSION['mensaje'] != "") {
  if ($_SESSION['msg_status'] == 1) { ?>
    <div class="alert alert-success text-center"> <?php } else { ?> <div class="alert alert-danger text-center"> <?php } ?>
      <?php echo $_SESSION['mensaje']; ?>
      </div>
    <?php  }
  $_SESSION['mensaje'] = ""; ?>

    <div class="container mt-4">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-row">
          <div class="col">
            <label for="validationDefault01">
              <h4>Nombre del curso</h4>
            </label>
            <input type="text" class="form-control" id="validationDefault01" name="nombre" required>
          </div>
        </div>
        <div class="form-row pt-2">
          <div class="col">
            <label for="imagen_t">
              <h4>Imagen</h4>
            </label>
            <div class="form-group">
              <label class="btn btn-info" for="my-file-selector">
                <input required type="file" name="file" id="exampleInputFile">
              </label>
            </div>
          </div>
        </div>
        <div class="form-row pt-2">
          <div class="col">
            <div class="form-group">
              <label for="exampleFormControlTextarea1">
                <h4>Breve descripcion del curso</h4>
              </label>
              <textarea class="form-control" name="descripcion_curso" rows="3"></textarea>
            </div>
          </div>
        </div>
        <div class="form-row pt-2">
          <div class="col">
            <div class="form-group">
              <label for="exampleFormControlTextarea1">
                <h4>Categoria</h4>
              </label>
              <select required name="categoria">
                <option value="" disabled selected>-- Seleccione categoria --</option>
                <option value="1">Informatica</option>
                <option value="2">Gastronomia</option>
                <option value="3">Otro</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-row pt-2">
          <div class="col">
            <div class="form-group">
              <label for="cantidadModulos">
                <h4>Cantidad de modulos:</h4>
              </label>
              <input required type="number" min="0" max="10" step="1" id="cantidadModulos" name="cantidadModulos">
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col">
            <div class="text-center">
              <button class="btn btn-primary" name="newCourse" type="submit">Crear curso</button>
            </div>
          </div>
        </div>
      </form>
    </div>

    <?php
    require "./templates/footer.php";
    ?>
