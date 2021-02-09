<?php require "./templates/header.php";
if ($_SESSION['user']['acceso'] > 1) exit;

$db->query("SELECT personas.nombre, personas.apellido, personas.telefono, personas.email, curso.nombre as nombre_curso FROM personas INNER JOIN curso_p ON        personas.id = curso_p.id_persona LEFT JOIN curso ON curso.id_curso = curso_p.id_curso WHERE curso_p.pago = 0");

$nopagos = $db->fetchAll();
?>

<div class="container">
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fadein active" id="diario">
      <div class="list-group">
      <?php
      foreach ($nopagos as $temp) {
          if ($lead['label'] == 7) continue; ?>
          <form action="./lead.php" method="post">
            <button class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?=$temp['nombre']; $temp['apellido'];?></h5>
                <small><?= $lead['date'] ?></small>
              </div>
              <p class="mb-1"><?= $lead['description'] ?></p>
              <small><?= $lead['email'] . " - " . $lead['phone'] ?></small>
            </button>
            <input type="hidden" name="lead" value="<?= $lead['id']; ?>">
          </form>
        <?php } ?>
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