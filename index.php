<?php
require "./templates/header.php";
$_SESSION['mensaje'] = "";
?>

<div class="swiper-container" id="swiper-banner">
  <div class="swiper-wrapper">
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