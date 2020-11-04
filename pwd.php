<?php
require "./templates/header.php";

if ($_SESSION['mensaje'] != "") {
  if ($_SESSION['msg_status'] == 1) { ?>
    <div class="alert alert-success text-center"> <?php } else { ?> <div class="alert alert-danger text-center"> <?php } ?>
      <?php echo $_SESSION['mensaje']; ?>
      </div>
    <?php } $_SESSION['mensaje'] = ""; ?>

    <div class="container mt-5">
      <form action="admin.php" method="post" enctype="multipart/form-data">
        <?php if ($_SESSION['user']['acceso'] == 2) { ?>
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
          <?php if ($_SESSION['user']['acceso'] != 2) { ?>
            <div class="col">
            <label for="validationDefault01">
              <h5>Contraseña actual</h5>
            </label>
            <input type="password" class="form-control" id="pwd_actual" name="pwd_actual" required>
          </div>
          <?php } ?>
        </div>
        <div class="form-row mt-3">
          <div class="col">
            <label for="validationDefault01">
              <h5>Nueva contraseña</h5>
            </label>
            <input type="password" class="form-control" id="pwd_1" name="pwd_1" required>
          </div>
        </div>
        <div class="form-row mt-3">
          <div class="col">
            <label for="validationDefault01">
              <h5>Repita nueva contraseña</h5>
            </label>
            <input type="password" class="form-control" id="pwd_2" name="pwd_2" required>
          </div>
        </div>
        <div class="form-row mt-3">
          <div class="col">
            <div class="text-center">
              <button class="btn btn-primary mt-3" name="btnAccion" value="password_change" type="submit">Cambiar contraseña</button>
            </div>
          </div>
        </div>
      </form>
    </div>
<?php require "./templates/footer.php"; ?>