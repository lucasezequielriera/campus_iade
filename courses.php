<?php 
require "templates/header.php";
?>

<form class="container" action="admin.php" method="post"> <br> <br>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">Nombre del curso</label>
      <input type="text" class="form-control" id="validationDefault01" name="nombre" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Identificador</label>
      <input type="text" name="url_doc" class="form-control" id="validationDefault02" required>
    </div>
  </div>
  <button class="btn btn-primary" name="btnAccion" value="newCourse" type="submit">Crear curso</button>
</form>

<?php
require "templates/footer.php";
?> 