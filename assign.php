<?php
require "./templates/header.php";

//OJO CON EL PAGO, ESTA DESHABILITADO MIENTRAS MODIFICO LAS OPCIONES DE MODULO.

if (isset($_POST['courseAssign'])) {
  $userId = $db->escape($_POST['id_persona']);
  $course = $db->escape($_POST['course']);
  if ($_POST['pago'] == 1) $cond = 6;  //si pago todo

  //$pago1 = (isset($_POST['pago']) ? $db->escape($_POST['pago']) : 0);
  //$db->query("INSERT INTO curso_p (`id_curso`, `id_persona`, `nivel`, `pago` ) VALUES ('$course','$userId', '$cond', '$pago1');");
  $db->query("INSERT INTO curso_p (`id_curso`, `id_persona`, `nivel`) VALUES ('$course','$userId', '$cond');");  // esta linea se va

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
          <label class="form-check-label" for="invalidCheck2">Pago el curso completo?</label>
          <div>
            <label for="">Si</label>
            <input required type="radio" name="pago" value="1">
            <label for="">No</label>
            <input type="radio" name="pago" value="0">
          </div>
              <div id="Pago1" class="desc" style="display: none;">


                



                esto es si pago
              </div>

              <div id="Pago0" class="desc" style="display: none;">

                  //poner cantidad de cuotas y crear una tabla donde actualizarlo? 






                esto si no pago.
              </div>
        </div>
      </div>
      <div class="form-row">
        <div class="col-md-4 mb-3">
          <button class="btn btn-primary mt-5" name="courseAssign" type="submit">Asignar curso</button>
        </div>
      </div>
    </div>
    </form>

    <script>
      $(document).ready(function() {
        $("input[name$='pago']").click(function() {
          var test = $(this).val();

          $("div.desc").hide();
          $("#Pago" + test).show();
        });
      });
    </script>

    <?php
    require "./templates/footer.php";
    ?>
    <!-- <input class="form-check-input" name="pago" type="checkbox" value="1" id="invalidCheck2"> -->