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
      <form id="form_user" action="admin.php" method="post"> <br>
      <div class="form-row">
        <img src="" alt="profile-photo" id ="profile-photo" style="max-height: 200px;">
      </div>
      <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="">Documento</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupPrepend2">#</span>
              </div>
              <input type="number" disabled class="form-control" name="dni" id="dni_user" aria-describedby="inputGroupPrepend2" required>
            </div>
          </div>
        </div>

        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="validationDefault01">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
          </div>
          </div>
          
          <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="validationDefault02">Apellido</label>
            <input type="text" name="apellido" class="form-control" id="apellido" required>
          </div>
          </div>

        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="validationDefault03">Email</label>
            <input type="email" name="mail" class="form-control" id="email" placeholder="correo@ejemplo.com">
          </div>
        </div>

        <div class="form-row">
          <div class="col-md-3 mb-3">
            <label for="validationDefault04">Telefono</label>
            <input type="number" name="tel" class="form-control" id="tel" placeholder="Telefono movil o fijo">
          </div>
        </div>
        <button class="btn btn-success" id="btnUpdate" name="btnAccion" value="newUser" onclick='update();' type="submit">Guardar cambios</button>
        <button class='btn btn-danger ml-3' type='button' onclick='test();' id='btnCancel'>Cancelar</button>
      </form>
      <div class="botones"></div>
    </div>

 <script>
     function test() { 
        var datos = <?=$_SESSION['user']['dni'];?>;
        if (datos) {
          $.ajax({
            type: 'get',
            url: 'search.php',
            data: {
              dni: datos
            },
            success: function(response) {
              var data_alumno = JSON.parse(response);
              if (data_alumno==null) {
                alert("error");
                location.reload();
              }
              $("#profile-photo").attr("src", data_alumno.foto);
              $("#nombre").val(data_alumno.nombre);
              $("#apellido").val(data_alumno.apellido);
              $("#email").val(data_alumno.email);
              $("#tel").val(data_alumno.telefono);
              }
          });
        }
      }

      function update() {
        if (!($('#nombre').val() && $('#apellido').val())) {
          alert("Nombre y apellido son obligatorios");
          return;
        }
        var info = {
          "nombre": $("#nombre").val(),
          "apellido": $("#apellido").val(),
          "mail": $("#email").val(),
          "tel": $("#tel").val(),
        };

        if (info) {
          $.ajax({
            type: 'POST',
            url: 'update.php',
            data: info,
            success: function(response) {
              alert("Actualizado " + <?=$_SESSION['user']['dni'];?>);
              location.reload();
            }
          });
        }
      }
    </script>


<?php
require "./templates/footer.php";
?>