<?php
include './templates/header.php';
if (isset($_POST['btnSend'])) { 
	$destinatario = 'informes@escuelaiade.com';
	setlocale(LC_ALL, 'es_ES');
    $fecha = strftime("%A %d/%m/%Y, a las %k:%M:%S");

	$nombre = $_SESSION['user']['nombre'];
	$asunto = $_POST['category'];
	$email = $_POST['contact'];
	$mensaje = $_POST['message'];

	$header = "From: argentina@escuelasiade.com";
	$mensaje = "\n\nDatos de Contacto:" . "\n\nNombre: " . $nombre . "\nEmail: " . $email . "\nAsunto: " . $asunto . "\nMensaje: " . $mensaje;
  $asunto = 'De Escuelasiade.com el día ' . $fecha . ' sobre ' . $asunto . ' - ' . $nombre;

	mail($destinatario, utf8_decode($asunto), utf8_decode($mensaje), $header);
?>
  <div class="container">
    <div class="row">
      <h2>Enviado correctamente! le responderemos a la brevedad.</h2>
      <script>
        window.setTimeout(function() {
          window.location.href = "./index.php";
        }, 5000);
      </script>
    </div>
  </div>
<?php } else {
?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="well">
          <form class="form" action="" method="post">
            <fieldset>
              <legend class="text-center">Reporte de Problemas / Consultas</legend>
              <!-- Name input-->
              <div class="form-group">
                <label class="col-md-6 control-label" for="name">Categoria:</label>
                <div class="col-md-12">
                  <select name="category" required>
                    <option value="" selected disabled>Seleccione una opción</option>
                    <option value="">¿Cómo compro un curso nuevo?</option>
                    <option value="">No puedo rendir un examen</option>
                    <option value="">Otro</option>
                  </select>
                </div>
              </div>
              <!-- Email input-->
              <div class="form-group">
                <label class="col-md-3 control-label" for="email">Mail de contacto:</label>
                <div class="col-md-12">
                  <input name="contact" required type="mail" placeholder="Escriba su email" class="form-control">
                </div>
              </div>
              <!-- Message body -->
              <div class="form-group">
                <label class="col-md-3 control-label" for="message">Detalle del problema:</label>
                <div class="col-md-12">
                  <textarea class="form-control" required id="message" name="message" placeholder="Describa aquí su problema" rows="5"></textarea>
                </div>
              </div>
              <!-- Form actions -->
              <div class="form-group">
                <div class="col-md-12 text-left">
                  <button type="submit" name="btnSend" class="btn btn-success">Enviar Mensaje</button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="footercontentreport">
<?php
}  //Cierre del else
include './templates/footer.php';
?>
  </div>