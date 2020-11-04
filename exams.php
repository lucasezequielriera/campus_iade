<?php 
require "./templates/header.php";
?>

<div class="container my-3"> 
  <form action="quiz.php" method="post" name="form_course">
    <div class="row">
      <div class="col-6 p-0 mb-2">
          <select id="course" name="course" class="form-control" required> 
            <option hidden disabled selected value="">-- Seleccione curso --</option>
            <?php 
                  $db->query("SELECT * FROM curso");
                  $resp = $db->fetchAll(); 
                  foreach ($resp as $temp) { ?>
                      <option value="<?=$temp['id_curso'];?>"><?=$temp['nombre'];?></option>
                    <?php } ?>    
          </select>
      </div>
    </div>       <!--Primer row -->     
    </form>
        <?php if (isset($_POST['course'])) {
        $cursoId = $_POST['course'];
        $db->query("SELECT * 
                    FROM curso 
                    WHERE id_curso = $cursoId 
                    LIMIT 1");
        $curso = $db->fetch();
        ?>

    <div class="row">
        <div class="card col-8 align-self-center p-0">
            <img 
            class="card-img-top" 
            src="<?= $curso['imagen']?>"
            title="<?= $curso['nombre']?>" 
            alt="titulo"
            data-toggle="popover";
            data-trigger="hover";
            data-content="<?=$curso['descripcion']?>";
            height="250px";
            >
            <div class="card-body">
                <h1><?= $curso['nombre'];?></h1>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">Material de estudio</h4>
                    </div>
                    <div class="panel-body">    
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="80%">Nombre del Archivo</th>
                                    <th width="10%">Descargar</th>
                                </tr>
                            </thead>
                            <tbody id="body_mods">
                                <?php $archivos = scandir($curso['url_doc']);
                                for ($i=2; $i<8; $i++) { ?>
                                    <tr>
                                        <td class="text-left">
                                            <form action="modal.php" method="post">
                                                <button href="modal.php" type="submit" class="btn-info btn-sm"><?=$archivos[$i];?></button> 
                                                <input type="hidden" value="<?=$archivos[$i];?>" name="directorio">
                                                <input type="hidden" value="<?=$curso['url_doc'];?>" name="raiz">
                                           </form>
                                        </td>
                                        <td class="text-center"><a title="Descargar Archivo" href="<?=$curso['url_doc']; echo $archivos[$i];?>" download="<?php echo $archivos[$i]; ?>" style="color: blue; font-size:18px;"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                            <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                            </svg></a></td>
                                    </tr>  
                                <?php } ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!--Card -->
    </div> <!--segundo row -->
    <?php } ?>  <!-- If que muestra "Card" con info dle curso -->

</div>  


<script>
$(document).ready(function() {
  $('#course').on('change', function(e)  {
     e.preventDefault();
     document.forms['form_course'].submit();
  });
});

</script>

<?php
require "./templates/footer.php";
?>