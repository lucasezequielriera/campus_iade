<?php require "templates/header.php";
?>



<div class="col-md-4 mb-3">
          <label for="">Documento</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="inputGroupPrepend2">#</span>
            </div>
            <input type="number" class="form-control" name="dni" id="dni_user" placeholder="Numero de documento sin puntos" aria-describedby="inputGroupPrepend2" required>
            <button id="btnSearch" class="btn-sm btn-warning">Buscar</button>
          </div>
        </div>




<script>
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

<?php require "templates/footer.php";
?>