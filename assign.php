<?php
require "./templates/header.php";

if (isset($_POST['courseAssign'])) {
  $nombre = $_POST['id_persona']; //id_persona
  $course = $_POST['course']; //id curso
  $pago1 = (isset($_POST['pago']) ? $_POST['pago'] : 0);
  $cond = 6;
  $db->query("INSERT INTO curso_p (`id_curso`, `id_persona`, `nivel`, `pago` ) 
                  VALUES ('$course','$nombre', '$cond', '$pago1');");
  $_SESSION['mensaje'] = "Curso asignado!";
  $_SESSION['msg_status'] = 1;
}

if ($_SESSION['mensaje'] != "") {
  if ($_SESSION['msg_status'] == 1) { ?>
    <div class="alert alert-success text-center"> <?php } else { ?> <div class="alert alert-danger text-center"> <?php } ?>
      <?php echo $_SESSION['mensaje']; ?>
      </div>
    <?php  }
  $_SESSION['mensaje'] = ""; ?>

    <form class="container mt-2" action="" method="post">
      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="validationDefault01">Alumno</label>
          <select name="id_persona" class="form-control" required>
            <option hidden disabled selected value="">-- Seleccione alumno --</option>
            <?php
            $db->query("SELECT * FROM personas");
            $resp = $db->fetchAll();
            foreach ($resp as $temp) { ?>
              <option value="<?= $temp['id']; ?>"><?= $temp['dni']; ?> <?= $temp['nombre']; ?> <?= $temp['apellido']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-4 mb-3">
          <label for="validationDefault04">Curso</label>
          <select name="course" class="form-control" required>
            <option hidden disabled selected value="">-- Seleccione curso --</option>
            <?php
            $db->query("SELECT * FROM curso");
            $resp = $db->fetchAll();
            foreach ($resp as $temp) { ?>
              <option value="<?= $temp['id_curso']; ?>"><?= $temp['nombre']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="form-check mt-2">
          <input class="form-check-input" name="pago" type="checkbox" value="1" id="invalidCheck2">
          <label class="form-check-label" for="invalidCheck2">Pago completo</label>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-4 mb-3">
          <button class="btn btn-primary mt-5" name="courseAssign" type="submit">Asignar curso</button>
        </div>
      </div>
    </div>
    </form>

    <?php
    require "./templates/footer.php";
    ?>