<?php 
require "templates/header.php";

if ($_SESSION['mensaje'] !="") {
  if ($_SESSION['msg_status'] == 1) { ?>
    <div class="alert alert-success text-center"> <?php }
      else { ?> <div class="alert alert-danger text-center">  <?php } ?>
      <?php echo $_SESSION['mensaje'];?>
    </div>
 <?php  } $_SESSION['mensaje']=""; ?>
        
<div class="container">
  <form action="admin.php" method="post" enctype="multipart/form-data"> <br> <br>
    <div class="form-row">
      <div class="col">
        <label for="validationDefault01"><h4>Nombre del curso</h4></label>
        <input type="text" class="form-control" id="validationDefault01" name="nombre" required>
      </div>
    </div>
    <div class="form-row pt-2">
      <div class="col">
        <label for="imagen_t"><h4>Imagen</h4></label>
        <div class="form-group">
          <label class="btn btn-info" for="my-file-selector">
            <input required type="file" name="file" id="exampleInputFile">
          </label>      
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="col">
        <div class="text-center">
          <button class="btn btn-primary" name="btnAccion" value="newCourse" type="submit">Crear curso</button>
        </div>
      </div>
    </div>
  </div>

<?php 
require "templates/footer.php";
?> 