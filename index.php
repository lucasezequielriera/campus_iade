<?php
require "./templates/header.php";
$_SESSION['mensaje'] = "";
?>

<div class="publicidad">
  <div class="row" style="height: 15vh;">
    <div class="col-4" style="border: 1px solid blue;">
        carousel anuncios
    </div>

    <div class="col-2 align-items-center" style="border: 1px solid red;">
      <img src="./img/tooeshoplogo.png" alt="tooEshop logo">
    </div>

    <div class="col-1" style="border: 2px solid pink;">
      btn1
    </div>
    <div class="col-1" style="border: 2px solid pink;">
      btn2
    </div>

    <div class="col-4" style="border: 2px solid pink;">
      banner con publicidad p alumno 
    </div>
  </div> <!-- row -->
</div><!-- container -->

<div class="cuerpoindex" style="border: 1px solid red;">
  <div class="row" style="border: 1px solid blue; height: 50vh">
    <div class="col-5" style="border: 1px solid red;">
      <div class="row" style="height: 15vh; margin-top: 100px">
        <div class="col-4" style="border: 1px solid green">curos 1</div>
        <div class="col-4" style="border: 1px solid green">curso 2</div>
        <div class="col-4" style="border: 1px solid green">curso 3</div>
      </div>
      <div class="row" style="height: 15vh;">
        <div class="col-4" style="border: 1px solid green">curos 4</div>
        <div class="col-4" style="border: 1px solid green">curso 5</div>
        <div class="col-4" style="border: 1px solid green">curso 6</div>
      </div>
    </div>
    <div class="col-7" style=" height: 70vh; border: 1px solid red;">
    <iframe width="100%" height="80%" src="https://www.youtube.com/embed/CFXvfBL4WkU?controls=0" style = "margin-top: 50px" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
  </div>
  <div>
    <div class="row">
      <div class="col-2" style="border: 1px solid orange; height: 20vh;">Titulo ejemplo</div>
      <div class="col-2" style="border: 1px solid orange; height: 20vh;">Titulo ejemplo 2</div>
    </div>
  </div>
</div>

<script>
  $('#myCarousel').carousel({
    interval: 1000,
    cycle: true
  });
</script>

<?php
require "./templates/footer.php";
?>