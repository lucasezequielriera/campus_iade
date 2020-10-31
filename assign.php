<?php 
require "templates/header.php";

if ($_SESSION['mensaje'] !="") {
  if ($_SESSION['msg_status'] == 1) { ?>
    <div class="alert alert-success text-center"> <?php }
      else { ?> <div class="alert alert-danger text-center">  <?php } ?>
      <?php echo $_SESSION['mensaje'];?>
    </div>
 <?php  } $_SESSION['mensaje']=""; ?>

<form class="container" action="admin.php" method="post">
  <div class="container"> <br> <br>
    <div class="form-row">
      <div class="col-md-4 mb-3">
        <label for="validationDefault01">Alumno</label>
        <select name="id_persona" class="form-control" required>
          <option hidden disabled selected value="">-- Seleccione alumno --</option>
          <?php 
                $db->query("SELECT * FROM personas");
                $resp = $db->fetchAll(); 
                foreach ($resp as $temp) { ?>
                    <option value="<?=$temp['id'];?>"><?=$temp['dni'];?> <?=$temp['nombre'];?> <?=$temp['apellido'];?></option>
                <?php } ?>    
        </select>
        <div class="form-check mt-2">
          <input type="checkbox" class="form-check-input" name="cond_libre">
          <label class="form-check-label" for="exampleCheck1">Cursada libre</label>
        </div>
      </div>
      <div class="col-md-4 mb-3">
      <label for="validationDefault04">Curso</label>
        <select name="course" class="form-control" required>
          <option hidden disabled selected value="">-- Seleccione curso --</option>
          <?php 
                $db->query("SELECT * FROM curso");
                $resp = $db->fetchAll(); 
                foreach ($resp as $temp) { ?>
                    <option value="<?=$temp['id_curso'];?>"><?=$temp['nombre'];?></option>
                <?php } ?>    
        </select>
        <div class="form-check mt-2">
          <input class="form-check-input" name="pago" type="checkbox" value="1" id="invalidCheck2">
          <label class="form-check-label" for="invalidCheck2">Curso pago</label>
        </div>
      </div>            
    </div>
    <div class="form-row">
      <div class="col-md-4 mb-3">
        <button class="btn btn-primary mt-5" name="btnAccion" value="courseAssign" type="submit">Asignar curso</button>
      </div>
    </div>
  </div>
</form>

<?php
require "templates/footer.php";
?>