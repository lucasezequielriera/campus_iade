<?php
require "./templates/header.php";

if (isset($_POST['courseAssign'])) {
  $userId = $db->escape($_POST['id_persona']);
  $course = $db->escape($_POST['course']);
  $cantidad_cuotas = $db->escape($_POST['cantidad_cuotas']);
  $valor_cuota = $db->escape($_POST['valor_cuota']);
  $pago = 1;
  $cuotas_pagas = 0;
  $db->query("SELECT cantidad_modulos FROM curso WHERE id_curso = '$course' LIMIT 1");
  $temp = $db->fetch();
  $nivel = $temp['cantidad_modulos'];

  $db->query("SELECT * FROM curso_p WHERE id_curso = '$course' AND id_persona = '$userId' LIMIT 1");
  $validate = $db->fetchAll();
  if (count($validate) > 0) {
    $_SESSION['mensaje'] = "El curso ya se encuentra asignado a esa persona!";
    $_SESSION['msg_status'] = 0;
  } else {
    if ($_POST['pago'] == 1) {
      $db->query("INSERT INTO curso_p (`id_curso`, `id_persona`, `nivel`, `pago`) VALUES ('$course','$userId', $nivel, '$pago');");
    } else {
      $pago = 0;
      $db->query("INSERT INTO curso_p (`id_curso`, `id_persona`, `nivel`, `pago`, `cantidad_cuotas`, `cuotas_pagas`, `valor_cuota`) VALUES ('$course','$userId', $nivel,'$pago', '$cantidad_cuotas', '$cuotas_pagas', '$valor_cuota');");
    }
    $_SESSION['mensaje'] = "Curso asignado!";
    $_SESSION['msg_status'] = 1;
  }
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
          <h3 class="form-check-label " for="invalidCheck2">Pago el curso completo?</h3>
          <div class="mt-3">
            <label for="">Si</label>
            <input required type="radio" name="pago" value="1">
            <label for="">No</label>
            <input type="radio" name="pago" value="0">
          </div>
          <div id="Pago1" class="desc" style="display: none;">
          </div>
          <div id="Pago0" class="desc" style="display: none;">
            <div>
              <label for="cuotas">Ingrese cantidad de cuotas: </label>
              <input type="number" step="1" min="2" max="10" name="cantidad_cuotas">
            </div>
            <div>
              <label for="cuotas">Ingrese valor de la cuota: </label>
              <input type="number" min="0" placeholder="$$$" name="valor_cuota">
            </div>
          </div>
        </div>
      </div>

      <div class="form-row">
        <button class="btn btn-primary mt-5" name="courseAssign" type="submit">Asignar curso</button>
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