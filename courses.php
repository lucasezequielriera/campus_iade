<?php
require "./templates/header.php";

if ($_SESSION['mensaje'] != "") {
  if ($_SESSION['msg_status'] == 1) { ?>
    <div class="alert alert-success text-center"> <?php } else { ?> <div class="alert alert-danger text-center"> <?php } ?>
      <?php echo $_SESSION['mensaje']; ?>
      </div>
    <?php  }
  $_SESSION['mensaje'] = ""; ?>

    <div class="container mt-4">
      <form action="admin.php" method="post" enctype="multipart/form-data">
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
              <select name="categoria">
                <option hidden selected disabled>-- Seleccione categoria --</option>
                <option value="1">Informatica</option>
                <option value="2">Gastronomia</option>
                <option value="3">Otro</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col">
            <div class="text-center">
              <button class="btn btn-primary" name="btnAccion" value="newCourse" type="submit">Crear curso</button>
            </div>
          </div>
        </div>
      </form>
    </div>

<?php
require "./templates/footer.php";
?>