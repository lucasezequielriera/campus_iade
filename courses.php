<?php 
require "templates/header.php";

?>

<div class="container">
  <form action="admin.php" method="post" enctype="multipart/form-data"> <br> <br>
    <div class="form-row">
      <div class="col-md-4 mb-3">
        <label for="validationDefault01">Nombre del curso</label>
        <input type="text" class="form-control" id="validationDefault01" name="nombre" required>
      </div>
    </div>
    <div class="form-row">
      <div class="panel-heading">
        <h4>Imagen</h4>
      </div>
      <div class="panel-body">
        <div class="col-lg-6">
            <div class="form-group">
              <label class="btn btn-primary" for="my-file-selector">
                <input required type="file" name="file" id="exampleInputFile">
              </label>      
            </div>
          </div>
        </div>
    </div>
    <div class="text-center">
      <button class="btn btn-primary" name="btnAccion" value="newCourse" type="submit">Crear curso</button>
    </div>
  </form>
</div>

<?php if ($mensaje !="") {?>
            <div class="alert alert-success">
                <?php echo $mensaje;?>
            </div>
        <?php } ?>

<?php 
require "templates/footer.php";
?> 