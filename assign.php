<?php 
require "templates/header.php";
?>

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
        <div class="form-check">
          <input type="checkbox" class="form-check-input" name="cond_libre">
          <label class="form-check-label" for="exampleCheck1">Cursa libre?</label>
        </div>

      </div>            
    </div>
    <button class="btn btn-primary" name="btnAccion" value="courseAssign" type="submit">Asignar curso</button>
  </div>
</form>

<?php
require "templates/footer.php";
?>