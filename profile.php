<?php
require "./templates/header.php";
$persona_id = $db->escape($_SESSION['user']['id']);

if (isset($_POST['set'])) {
  $file = $_FILES['file'];
  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];
  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));
  $allowed = array('jpg', 'jpeg', 'png');

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 500000) {
        $fileNameNew =  $persona_id . "." . $fileActualExt;
        $fileDestination = './img/' . $fileNameNew;
        $fileDestination = $db->escape($fileDestination);
        if (move_uploaded_file($fileTmpName, $fileDestination)) {
          $db->query("UPDATE `personas` SET `foto`= '$fileDestination' WHERE id = '$persona_id'");
          $_SESSION['mensaje'] = "Se ha cargado con exito la imagen!";
          $_SESSION['msg_status'] = 1;
        }
      } else {
        $_SESSION['mensaje'] = "Error, el archivo supera los 500kb";
        $_SESSION['msg_status'] = 0;
      }
    } else {
      $_SESSION['mensaje'] = "Error al cargar el archivo";
      $_SESSION['msg_status'] = 0;
    }
  } else {
    $_SESSION['mensaje'] = "Error, solo archivos JPG, JPEG o PNG son aceptados.";
    $_SESSION['msg_status'] = 0;
  }
}

$db->query("SELECT * FROM personas WHERE id = '$persona_id' LIMIT 1");
$datos_usuario = $db->fetch();

if ($_SESSION['mensaje'] != "") {
  if ($_SESSION['msg_status'] == 1) { ?>
    <div class="alert alert-success text-center"> <?php } else { ?> <div class="alert alert-danger text-center"> <?php } ?>
      <?php echo $_SESSION['mensaje']; ?>
      </div>
    <?php  }
  $_SESSION['mensaje'] = ""; ?>

    <div class="container mt-4">
      <div class="profileform">
        <form class="text-center" action="" id="form_photo" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <div class="image-upload">
                <label for="file-input">
                  <img src="<?= $datos_usuario['foto']; ?>" alt="profile-photo" id="profile-photo" style="max-height: 170px; min-height:100px; border: 3px solid black;" /><br>
                  <font size="2" color="grey">Clickeá en la foto para cambiar tu foto de perfil</font>
                </label>
                <input type="hidden" value="1" name="set">
                <input id="file-input" required type="file" name="file" accept="image/png, image/jpeg, image/jpg" style="display: none;" />
              </div>
            </div>
          </div>
        </form>
        <form action="" method="post" class="formulario text-center">
          <div class="row mt-4">
            <div hidden class=" col-12 mb-3">
              <label for="">Documento</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupPrepend2">#</span>
                </div>
                <input type="number" disabled class="form-control" name="dni" id="dni_user" value="<?= $datos_usuario['dni']; ?>" aria-describedby="inputGroupPrepend2" required>
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationDefault01">Nombre Completo</label>
              <input type="text" class="form-control" id="nombre" value="<?= $datos_usuario['nombre']; ?>" name="nombre" required>
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationDefault02">Apellido Completo</label>
              <input type="text" name="apellido" class="form-control" id="apellido" value="<?= $datos_usuario['apellido']; ?>" required>
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationDefault03">Email de Contacto</label>
              <input type="email" name="mail" class="form-control" id="email" value="<?= $datos_usuario['email']; ?>" placeholder="correo@ejemplo.com">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationDefault04">Teléfono o Celular</label>
              <input type="number" name="tel" class="form-control" id="tel" value="<?= $datos_usuario['telefono']; ?>" placeholder="Telefono movil o fijo">
            </div>
            <div class="botonesformulario">
              <button class="btn btn-success" onclick='update();' type="submit">Guardar cambios</button>
              <a href="index.php" class='btn btn-danger ml-3'>Cancelar</a>
            </div>
          </div>
        </form>
      </div>
    </div>

    <script>
      // var save = document.getElementById("btnSave");
      //     	save.addEventListener("keydown", function(e) {
      //       if (e.keyCode === 13) {
      //         update();
      //       }
      //     });  

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

        $.ajax({
          type: 'POST',
          url: 'update.php',
          data: info,
          success: function(response) {
            window.location.reload(true);
          }
        });
        window.location.reload(true);
      }

      document.getElementById("file-input").onchange = function() {
        document.getElementById("form_photo").submit();
      };
    </script>

    <?php
    require "./templates/footer.php";
    ?>