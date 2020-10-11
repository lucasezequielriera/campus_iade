<?php 
require "templates/header.php";
include "download.php";
?>


<div class="row">

<?php
    $db = Database::getInstance();
    $db->query("SELECT * 
                FROM curso 
                LEFT JOIN curso_p ON curso.id_curso = curso_p.id_curso
                WHERE curso_p.id_persona = " . $_SESSION['user']['id']);
    $resp = $db->fetchAll();

foreach($resp as $curso) {?>
    <div class="col-10 offset-1 offset-md-0 col-md-3 col-lg-4">
      <div class="card">
          <img 
          class="card-img-top" 
          src="<?= $curso['imagen']?>"
          title="<?= $curso['nombre']?>" 
          alt="titulo"
          data-toggle="popover";
          data-trigger="hover";
          data-content="<?= $curso['descripcion']?>";
          height="250px";
          >

        <form action="" method="POST"> <div class="card-body">
                <h3><?= $curso['nombre']?></h3>
                <button type="submit" 
                name="btnAccion" 
                value="<?=$curso['id_curso']?>;" 
                class="card-text btn btn-info">
                Descargar material
              </button>
            </div>
        </form>
      </div>
    </div>
  
<?php } ?>


<?php
require "templates/footer.php";
?>