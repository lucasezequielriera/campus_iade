<?php
require "./templates/header.php";

if ($_SESSION['mensaje'] != "") {
  if ($_SESSION['msg_status'] == 1) { ?>
    <div class="alert alert-success text-center"> <?php } else { ?> <div class="alert alert-danger text-center"> <?php } ?>
      <?php echo $_SESSION['mensaje']; ?>
      </div>
    <?php  }
  $_SESSION['mensaje'] = ""; ?>

    <div class="container">
      <form id="form_user" action="admin.php" method="post"> <br> <br>
        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="validationDefault01">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
          </div>
          <div class="col-md-4 mb-3">
            <label for="validationDefault02">Apellido</label>
            <input type="text" name="apellido" class="form-control" id="apellido" required>
          </div>
          <div class="col-md-4 mb-3">
            <label for="">Documento</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupPrepend2">#</span>
              </div>
              <input type="number" class="form-control" name="dni" id="dni_user" placeholder="Numero de documento sin puntos" aria-describedby="inputGroupPrepend2" required>
              <button id="btnSearch" type="button" class="btn-sm btn-warning">Buscar</button>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="validationDefault03">Email</label>
            <input type="email" name="mail" class="form-control" id="email" placeholder="correo@ejemplo.com">
          </div>
          <div class="col-md-3 mb-3">
            <label for="validationDefault04">Telefono</label>
            <input type="number" name="tel" class="form-control" id="tel" placeholder="Telefono movil o fijo">
          </div>
          <div class="col-md-3 mb-3">
            <label for="validationDefault04">Tipo de usuario</label>
            <select name="userAccess" class="form-control" id="user_type" required>
              <option hidden disabled selected value="">-- Seleccione --</option>
              <option value="0">Alumno</option>
              <option value="1">Profesor</option>
              <option value="2">Administrador</option>
            </select>
          </div>
        </div>
        <button class="btn btn-primary" id="btn_alta" name="btnAccion" value="newUser" type="submit">Dar de alta usuario</button>
      </form>
      <div class="botones"></div>
    </div>

    <script>
      $("#btnSearch").click(function() {
        var datos = $('#dni_user').val();
        if (datos) {
          $('#dni_user').prop("disabled", true);
          $.ajax({
            type: 'get',
            url: 'search.php',
            data: {
              dni: datos
            },
            success: function(response) {
              var data_alumno = JSON.parse(response);
              if (data_alumno==null) {
                alert ("No se encontro usuario.")
                location.reload();
              }
              $("#nombre").val(data_alumno.nombre);
              $("#apellido").val(data_alumno.apellido);
              $("#email").val(data_alumno.email);
              $("#tel").val(data_alumno.telefono);
              $("#user_type").val(data_alumno.acceso);
              $("#btn_alta").hide();
              $(".botones").append("<button class='btn btn-success' type='button' id='btnUpdate' onclick='update();'>Modificar datos</button>");
              $(".botones").append("<button class='btn btn-danger ml-3' type='button' onclick='cancel();' id='btnCancel'>Cancelar</button>");
            }
          });
        }
      });


      function cancel() {
        $('#dni_user').prop("disabled", false);
        $('#form_user ').trigger("reset");
        location.reload();
      }


      function update() {
        if (!($('#nombre').val() && $('#apellido').val())) {
          alert("Nombre y apellido son obligatorios");
          return;
        }
        var info = {
          "dni": $('#dni_user').val(),
          "nombre": $("#nombre").val(),
          "apellido": $("#apellido").val(),
          "mail": $("#email").val(),
          "tel": $("#tel").val(),
          "type": $("#user_type").val()
        };

        if (info) {
          $.ajax({
            type: 'POST',
            url: 'update.php',
            data: info,
            success: function(response) {
              alert("Actualizado " + $('#dni_user').val());
              location.reload();
            }
          });
        }
      }
    </script>

<?php
require "./templates/footer.php";
?>