<?php
require "./templates/header.php";

if (isset($_POST['courseAssign'])) {
  $userId = $db->escape($_POST['id_persona']);
  $course = $db->escape($_POST['course']);
  $cantidad_cuotas = $db->escape($_POST['cantidad_cuotas']);
  $valor_cuota = $db->escape($_POST['valor_cuota']);
  $pago = 1;
  $cuotas_pagas = 0;
  $presencial =  $db->escape($_POST['presencial']);
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
      $db->query("INSERT INTO curso_p (`id_curso`, `id_persona`, `nivel`, `pago`, `presencial`) VALUES ('$course','$userId', '$nivel', '$pago', '$presencial');");
    } else {
      $pago = 0;
      $nivel = intval($temp['cantidad_modulos'] / $cantidad_cuotas);
      if ($nivel >= 0 && $nivel < 1) $nivel = 1;
      $db->query("INSERT INTO curso_p (`id_curso`, `id_persona`, `nivel`, `pago`, `cantidad_cuotas`, `cuotas_pagas`, `valor_cuota`, `presencial`) VALUES ('$course','$userId', '$nivel', '$pago', '$cantidad_cuotas', '$cuotas_pagas', '$valor_cuota', '$presencial');");
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

    <div class="container">
      <div class="col-md-8 my-3 pl-0">
        <div class="input-group">
          <input type="text" class="form-control" name="search" id="search" placeholder="Busqueda por documento, email o teléfono" aria-describedby="inputGroupPrepend2">
          <button id="btnSearch" type="button" class="btn-sm btn-warning">Buscar</button>
        </div>
      </div>
    </div>

    <form class="container mt-2" action="" method="post">
      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="validationDefault01">Datos del alumno</label> <br>
          <input type="hidden" name="id_persona" id="id_persona" required>
          <input type="text" name="dni" id="dni" value="" placeholder="Documento" disabled required>
          <input type="text" name="nombre" id="nombre" value="" placeholder="Nombre" disabled required>
          <input type="text" name="apellido" id="apellido" value="" placeholder="Apellido" disabled required>
          <input type="text" name="email" id="email" value="" placeholder="Email" disabled>
          <input type="text" name="tel" id="tel" value="" placeholder="Teléfono" disabled>
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

          <div class="form-check mt-2 p-0">
            <h5 class="form-check-label" for="invalidCheck2">Cursa presencial?</h5>
            <div class="mt-1 ml-4">
              <label for="">Si</label>
              <input required type="radio" name="presencial" value="1">
              <label for="">No</label>
              <input type="radio" name="presencial" value="0">
            </div>
            <h5 class="form-check-label" for="invalidCheck2">Pago el curso completo?</h5>
            <div class="mt-1 ml-4">
              <label for="">Si</label>
              <input required type="radio" name="pago" value="1">
              <label for="">No</label>
              <input type="radio" name="pago" value="0">
            </div>
            <div id="Pago1" class="desc" style="display: none;">
            </div>
            <div id="Pago0" class="desc" style="display: none;">
              <div>
                <label for="cuotas">Cantidad de cuotas:</label>
                <input type="number" step="1" min="2" max="10" name="cantidad_cuotas" required>
              </div>
              <div>
                <label for="cuotas">Valor cuota:</label>
                <input type="number" min="0" placeholder="$$$" name="valor_cuota" required>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button class="btn btn-primary" name="courseAssign" type="submit">Asignar curso</button>
    </form>

    <script>
      $(document).ready(function() {
        $("input[name$='pago']").click(function() {
          var test = $(this).val();

          $("div.desc").hide();
          $("#Pago" + test).show();
        });
      });

      $("#btnSearch").click(function() {
        var datos = $('#search').val();
        if (datos) {
          $.ajax({
            type: 'get',
            url: 'search.php',
            data: {
              dni: datos
            },
            success: function(response) {
              var data_alumno = JSON.parse(response);
              if (data_alumno == null) {
                alert("No se encontro usuario.")
                location.reload();
              }
              $("#dni").val(data_alumno.dni);
              $("#nombre").val(data_alumno.nombre);
              $("#apellido").val(data_alumno.apellido);
              $("#email").val(data_alumno.email);
              $("#tel").val(data_alumno.telefono);
              $("#id_persona").val(data_alumno.id);
            }
          });
        }
      });
    </script>

    <?php
    require "./templates/footer.php";
    ?>