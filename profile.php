<?php
require "./templates/header.php";

$persona_id = $_SESSION['user']['id'];
$db->query("SELECT * FROM personas WHERE id = $persona_id");
$datos_usuario = $db->fetch();


if (isset($_FILES["file"])) {

    $directoryName = './cursos/' . $nombre;
    $examDirectory = $directoryName . '/' . 'exams/';
    $target_dir = $directoryName . '/';
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
      $uploadOk = 1;
    } else {
      $uploadOk = 0;
    }

    if ($_FILES["file"]["size"] > 1100000) {  // MAX 1mb
      $err = "Error, el archivo supera 1 Mb";
      $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
      $err = "Error, solo archivos JPG, JPEG o PNG son aceptados.";
      $uploadOk = 0;
    }

  if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["file"]["tmp_name"],$target_file)) {
      $db->query("INSERT INTO personas (`imagen`)
      VALUES ('$target_file') WHERE id = '$'");
    }
  }
}
?>

<div class="container mt-4">
  <form action="">
    <div class="row">
      <img src="<?= $datos_usuario['foto']; ?>" alt="profile-photo" id="profile-photo" style="max-height: 200px; border: 3px solid black;">
    </div>
    <div class="row">
        <form action="" method="post">
          <div class="form-group">
            <label class="btn" for="my-file-selector">
              <input required type="file" name="file" id="exampleInputFile">
            </label>      
          </div>
        </form>
      </div>
      <!-- DOCUMENTO -->
    <div hidden class="row mt-4"">
      <div class="col-md-4 mb-3">
        <label for="">Documento</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupPrepend2">#</span>
          </div>
          <input type="number" disabled class="form-control" name="dni" id="dni_user" value="<?= $datos_usuario['dni']; ?>" aria-describedby="inputGroupPrepend2" required>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-md-4 mb-3">
        <label for="validationDefault01">Nombre</label>
        <input type="text" class="form-control" id="nombre" value="<?= $datos_usuario['nombre']; ?>" name="nombre" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 mb-3">
        <label for="validationDefault02">Apellido</label>
        <input type="text" name="apellido" class="form-control" id="apellido" value="<?= $datos_usuario['apellido']; ?>" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="validationDefault03">Email</label>
        <input type="email" name="mail" class="form-control" id="email" value="<?= $datos_usuario['email']; ?>" placeholder="correo@ejemplo.com">
      </div>
    </div>

    <div class="row">
      <div class="col-md-3 mb-3">
        <label for="validationDefault04">Telefono</label>
        <input type="number" name="tel" class="form-control" id="tel" value="<?= $datos_usuario['telefono']; ?>" placeholder="Telefono movil o fijo">
      </div>
    </div>
    <button class="btn btn-success" onclick='update();' type="submit">Guardar cambios</button>
    <a href="index.php" class='btn btn-danger ml-3'>Cancelar</a>
  </form>
  <div class="botones"></div>
</div>

<script>
  function update() {
    if (!($('#nombre').val() && $('#apellido').val())) {
      alert("Nombre y apellido son obligatorios");
      return;
    }
    var info = {
      "nombre": $("#nombre").val(),
      "apellido": $("#apellido").val(),
      "mail": $("#email").val(),
      "tel": $("#tel").val(),
      "dni": $("#dni_user").val()
    };

    if (info) {
      $.ajax({
        type: 'POST',
        url: 'update.php',
        data: info,
        success: function(response) {
          $("#nombre").val();
          $("#apellido").val();
          $("#email").val();
          $("#tel").val();
          alert("Se modificaron los datos.");
          location.reload();
        }
      });
    }
  }
</script>

<?php
require "./templates/footer.php";
?>