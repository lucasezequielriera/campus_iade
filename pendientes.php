<?php require "./templates/header.php";
if ($_SESSION['user']['acceso'] > 1) exit;
?>

<div class="container">
<form class="mt-2" action="" method="post">
        <label for="buscador">Buscar</label>
        <input type="text" name="search" placeholder="Ingrese documento" required>
        <button class="btn btn-sm btn-info">Buscar</button>
  </form>
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fadein active" id="diario">
      <div class="list-group">
      <?php
          if (isset($_POST['search'])) {
            $search = $db->escape($_POST['search']);
            $db->query("SELECT personas.nombre, personas.apellido, personas.dni, personas.id, curso_p.cantidad_cuotas, curso_p.cuotas_pagas, curso_p.valor_cuota, curso.id_curso, curso.nombre AS nombre_curso FROM personas INNER JOIN curso_p ON personas.id = curso_p.id_persona LEFT JOIN curso ON curso.id_curso = curso_p.id_curso WHERE personas.dni = '$search' AND curso_p.pago = 0");
            $userValues = $db->fetchAll();

            if (count($userValues) == 0) { ?>
                <h3>No se encontro alumno</h3>
                <div><a class="btn btn-success" href="./pendientes.php">Volver</a></div>
                <?php exit; }
            foreach ($userValues as $temp) { ?>
                <form action="./payment_info.php" method="post">
                <button class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?=$temp['nombre']. " " . $temp['apellido'] . " - " . $temp['nombre_curso']?></h5>
                  </div>
                  <p class="mb-1"><?="Documento: " . $temp['dni']?></p>
                </button>
                <input type="hidden" name="course_id" value="<?=$temp['id_curso']?>">
                <input type="hidden" name="course_name" value="<?=$temp['nombre_curso']?>">
                <input type="hidden" name="persona_id" value="<?=$temp['id']?>">
                <input type="hidden" name="dni" value="<?=$temp['dni']?>">
                <input type="hidden" name="fullname" value="<?=$temp['nombre']. " " . $temp['apellido']?>">
                <input type="hidden" name="cantidad_cuotas" value="<?=$temp['cantidad_cuotas']?>">
                <input type="hidden" name="cuotas_pagas" value="<?=$temp['cuotas_pagas']?>">
                <input type="hidden" name="valor_cuota" value="<?=$temp['valor_cuota']?>">
              </form>
              <?php }
          } else {
            $db->query("SELECT personas.nombre, personas.apellido, personas.dni, personas.id, curso_p.cantidad_cuotas, curso_p.cuotas_pagas, curso_p.valor_cuota, curso.id_curso, curso.nombre AS nombre_curso FROM personas INNER JOIN curso_p ON personas.id = curso_p.id_persona LEFT JOIN curso ON curso.id_curso = curso_p.id_curso WHERE curso_p.pago = 0");
            $nopagos = $db->fetchAll();
            foreach ($nopagos as $temp) { ?>
              <form action="./payment_info.php" method="post">
                <button class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?=$temp['nombre']. " " . $temp['apellido'] . " - " . $temp['nombre_curso']?></h5>
                  </div>
                  <p class="mb-1"><?="Documento: " . $temp['dni']?></p>
                </button>
                <input type="hidden" name="course_id" value="<?=$temp['id_curso']?>">
                <input type="hidden" name="course_name" value="<?=$temp['nombre_curso']?>">
                <input type="hidden" name="persona_id" value="<?=$temp['id']?>">
                <input type="hidden" name="dni" value="<?=$temp['dni']?>">
                <input type="hidden" name="fullname" value="<?=$temp['nombre']. " " . $temp['apellido']?>">
                <input type="hidden" name="cantidad_cuotas" value="<?=$temp['cantidad_cuotas']?>">
                <input type="hidden" name="cuotas_pagas" value="<?=$temp['cuotas_pagas']?>">
                <input type="hidden" name="valor_cuota" value="<?=$temp['valor_cuota']?>">
              </form>
            <?php }
          } ?>
      </div>
    </div>
  </div>
</div>

<script>

function pago(id) {
  $.ajax({
      type: 'POST',
      url: 'pagos.php',
      data: id,
      success: function(response) {
        alert("Actualizado pago de " + $('#dni_user').val());
        location.reload();
      }
    });
}

$("#btnSearch").click(function() {
  var datos = $('#dni_user').val();
  if (datos){
  $.ajax({
    type: 'get',
    url: 'search.php',
    data: { dni : datos },
    success: function(response) {
      var data_alumno = JSON.parse(response); 
      $("#nombre").val(data_alumno.nombre);
      $("#apellido").val(data_alumno.apellido);
      $("#email").val(data_alumno.email);
      $("#tel").val(data_alumno.telefono);
      $("#user_type").val(data_alumno.acceso);

      $("#btn_alta").hide();
      $("#form_user").append("<button class='btn btn-success' onclick='stopDefAction(event);' id='btnUpdate'>Modificar datos</button>");
      $("#form_user").append("<button class='btn btn-danger ml-3' onclick='stopDefAction(event);' id='btnCancel'>Cancelar</button>");            
    }
  });
  }
});
</script>

<?php require "./templates/footer.php";
?>