<?php
require "./templates/header.php";
$_SESSION['mensaje'] = "";
?>

<div class="swiper-container" id="swiper-banner">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    <div class="swiper-slide">
    <img src="./img/banner2.png" alt="">
    </div>
    <div class="swiper-slide">
    <img src="./img/banner3.png" alt="">
    </div>
    <div class="swiper-slide">
      <img src="./img/banner1.png" alt="">
    </div>
  </div>
</div>

<div class="row m-0">
  <div class="col-12 col-md-6">
    <div class="row">
    <?php
    $db->query("SELECT * FROM curso");
    $listado_cursos = $db->fetchAll();
    for ($i = 0; $i < 6; $i++) { ?>
      <div class="col-12 col-lg-4">
        <div class="card mb-3 card-curso">
          <img class="card-img-top" src="<?= $listado_cursos[$i]['imagen']; ?>" alt="">
          <div class="card-body">
            <h5 class="card-title"><?= $listado_cursos[$i]['nombre']; ?></h5>
            <p class="card-text"><?= $listado_cursos[$i]['descripcion']; ?></p>
            <a class="btn btn-info" href="https://wa.me/5401134840208?text=Estoy%20interesado%20en%20el%20curso%20<?= $listado_cursos[$i]['nombre']; ?>%20-%20<?= $_SESSION['user']['nombre'] ?>">Consultar por este curso</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
  </div>
  
</div>

<script>
  var mySwiper = new Swiper('#swiper-banner', {
    // Optional parameters
    loop: true,
    autoplay: {
    delay: 5000,
  },
  })
</script>

<?php
require "./templates/footer.php";
?>