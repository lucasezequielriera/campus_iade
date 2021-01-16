<?php
require "./templates/header.php";

if (isset($_POST['password_change'])) {
  $user_id = $db->escape($_SESSION['user']['id']); 
  $pwd_1 = $db->escape($_POST['pwd_1']);
  $pwd_2 = $db->escape($_POST['pwd_2']);
  $db->query("SELECT `password` FROM personas WHERE id = '$user_id' LIMIT 1");
  $pwd_db = $db->fetch();

  if ($_SESSION['user']['acceso'] == 0) {
      $pwd_actual = $db->escape($pwd_db['password']);
      $temp_dni = $db->escape($_POST['dni']);
      $db->query("SELECT `id` FROM personas WHERE dni = '$temp_dni' LIMIT 1");
      $temp_dni = $db->fetch();
      $user_id = $db->escape($temp_dni['id']);
  }else {
      $pwd_actual = sha1($_POST['pwd_actual']);
  }
  
  if (strlen($pwd_1) < 5) {
      $_SESSION['mensaje'] = "La contraseña debe contener almenos 5 caracteres.";
      $_SESSION['msg_status'] = 0;

  } else {
      if ($pwd_actual == $pwd_db['password']) {
          if ($pwd_1 !== $pwd_2) {
              $_SESSION['mensaje'] = "Las contraseñas ingresadas no coinciden.";
              $_SESSION['msg_status'] = 0;
          } else {
              $pwd_2 = sha1($pwd_1);
              $db->query("UPDATE personas SET `password` = '$pwd_2'
                      WHERE id = '$user_id';");
              $_SESSION['mensaje'] = "Contraseña cambiada con exito!";
              $_SESSION['msg_status'] = 1;
          }
      } else {
          $_SESSION['mensaje'] = "La contraseña es incorrecta.";
          $_SESSION['msg_status'] = 0;
      }
  }
}

if ($_SESSION['mensaje'] != "") {
  if ($_SESSION['msg_status'] == 1) { ?>
    <div class="alert alert-success text-center"> <?php } else { ?> <div class="alert alert-danger text-center"> <?php } ?>
      <?php echo $_SESSION['mensaje']; ?>
      </div>
    <?php } $_SESSION['mensaje'] = ""; ?>

    <div class="container mt-5 pwd text-center">
      <div class="row">
        <div class="col-6 a">
          <form action="" method="post" enctype="multipart/form-data">
            <?php if ($_SESSION['user']['acceso'] == 0) { ?>
              <div class="form-row">
                <div class="col-6">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroupPrepend2">#</span>
                    </div>
                    <input type="number" class="form-control" name="dni" id="dni_user" placeholder="Ingrese documento" aria-describedby="inputGroupPrepend2" required>
                  </div>
                </div>
              </div>
            <?php } ?>

            <div class="form-row mt-3">
              <?php if ($_SESSION['user']['acceso'] != 0) { ?>
                <div class="col">
                <label for="validationDefault01">
                  <h5>Contraseña actual:</h5>
                </label>
                <input type="password" class="form-control" id="pwd_actual" name="pwd_actual" required>
              </div>
              <?php } ?>
            </div>
            <div class="form-row mt-3">
              <div class="col">
                <label for="validationDefault01">
                  <h5>Nueva contraseña:</h5>
                </label>
                <input type="password" class="form-control" id="pwd_1" name="pwd_1" required>
              </div>
            </div>
            <div class="form-row mt-3">
              <div class="col">
                <label for="validationDefault01">
                  <h5>Repita nueva contraseña:</h5>
                </label>
                <input type="password" class="form-control" id="pwd_2" name="pwd_2" required>
              </div>
            </div>
            <div class="form-row mt-3">
              <div class="col">
                <div class="text-center">
                  <button class="btn btn-success mt-3 float-center" name="password_change" type="submit">Cambiar contraseña</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="col-6 containerdeiade">
          <div class="imageniade">
            <img src="./img/logo-iade.png">
          </div>
        </div>
      </div>
    </div>

<div class="footercontentpwd">
  <?php require "./templates/footer.php"; ?>
</div>