<?php
require "./templates/header.php";

$db->query("SELECT * FROM curso");
$listado_cursos = $db->fetchAll();

?>
<!--<div class="card-deck">
</div>
-->
<div class="container">
    <div class="row">
        <?php foreach ($listado_cursos as $curso) { ?>
            <div class="col-lg-3">
                <div class="card mb-3">
                    <img class="card-img-top" style="height: 200px;" src="<?= $curso['imagen']; ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $curso['nombre'];?></h5>
                        <p class="card-text"><?= $curso['descripcion'];?></p>
                        <a class="btn btn-info" href="https://wa.me/5401134840208?text=Estoy%20interesado%20en%20el%20curso%20<?= $curso['nombre'];?>%20-%20<?=$_SESSION['user']['nombre']?>">Quiero este curso</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?
require "./templates/footer.php";
?>