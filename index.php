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

<div class="contenedor">

  <div class="titulo1" >
    <h3></h3>
  </div>
  <div class="titulo2">
    <h3></h3>
  </div>

  <main class="mainmenu">
    <a href="#"><img src="./img/17.jpg" width="180px">
    Aire Acondicionado</a>
    <a href="#"><img src="./img/01.jpg" width="180px">
    Plaquetas Electrónicas</a>
    <a href="#"><img src="./img/02.jpg" width="180px">
    Cerrajería</a>
    <a href="#"><img src="./img/26.jpg" width="180px">
    Electrónica</a>
    <a href="#"><img src="./img/33.jpg" width="180px">
    Motos</a>
    <a href="#"><img src="./img/35.jpg" width="180px">
    Motores de Moto</a>
  </main>

  <section class="videosection">
  <iframe width="700px" height="400px" src="https://www.youtube.com/embed/VsaG4BlRo_M" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </section>

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