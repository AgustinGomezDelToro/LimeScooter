<?php
session_start();
include("fb.php");
include("include/app.php");
include("include/menu.php");
?>

<!-- ====== Hero Start ====== -->
<section class="ud-hero" id="home">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="ud-hero-content wow fadeInUp" data-wow-delay=".2s">
          <h1 class="ud-hero-title">
            EASYSCOOTER
          </h1>
          <p class="ud-hero-desc"> <?php echo $lang['description']; ?>
            <!-- Des scooters 100% électriques, en libre-service, disponibles sur l’appli Easyscooter.-->
          </p>
          <form method="post" action="newsletter.php">
            <h2><?php echo $lang['Newsletter']; ?></h2>
            <div class="input-group">
              <input type="email" class="form-control" name="email" placeholder="Enter your email">
              <span class="input-group-btn">
                <button class="ud-main-btn1 btn" type="submit"><?php echo $lang['envoyer']; ?></button>
              </span>
            </div>
          </form>
          <ul class="ud-hero-buttons">
            <li>
              <a href="sign-up.php" rel="nofollow noopener" target="_blank" class="ud-main-btn ud-white-btn"><?php echo $lang['btn']; ?>
                <!-- Découvrez notre produit  -->
              </a>
            </li>
        </div>
      </div>
    </div>
</section>
<!-- ====== Hero End ====== -->

<!-- ====== Features Start ====== -->
<section id="features" class="ud-features">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="ud-section-title">

          <h2><?php echo $lang['advantages']; ?>
            <!-- Advantages d'utiliser Easyscooter --->
          </h2>
          <!--<p>
            ?????
          </p>-->
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-3">
        <div class="ud-single-feature wow fadeInUp" data-wow-delay=".1s">
          <div class="ud-feature-icon">
            <i class="lni lni-gift"></i>
          </div>
          <div class="ud-feature-content">
            <h3 class="ud-feature-title"><?php echo $lang['eco']; ?>
              <!-- Écologique -->
            </h3>
            <p class="ud-feature-desc">

            </p>
            <a href="javascript:void(0)" class="ud-feature-link">

            </a>
          </div>
        </div>
      </div>
      <div class="col-xl-3">
        <div class="ud-single-feature wow fadeInUp" data-wow-delay=".15s">
          <div class="ud-feature-icon">
            <i class="lni lni-move"></i>
          </div>
          <div class="ud-feature-content">
            <h3 class="ud-feature-title"><?php echo $lang['speed']; ?>
              <!-- Rapide -->
            </h3>
            <p class="ud-feature-desc">

            </p>
            <a href="javascript:void(0)" class="ud-feature-link">

            </a>
          </div>
        </div>
      </div>
      <div class="col-xl-3">
        <div class="ud-single-feature wow fadeInUp" data-wow-delay=".2s">
          <div class="ud-feature-icon">
            <i class="lni lni-layout"></i>
          </div>
          <div class="ud-feature-content">
            <h3 id="titlethree1" class="ud-feature-title"><?php echo $lang['inexpensive']; ?>
              <!-- Économique -->
            </h3>
            <p class="ud-feature-desc">

            </p>
            <a href="javascript:void(0)" class="ud-feature-link">

            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
<!-- ====== Features End ====== -->
<!-- ETAPES WEBGL-->
<section>
  <div class="containerfonction">
    <div class="text-center">
    </div>
    <div class="row">
      <div class="col-md-6 timeline">
        <ul class="text-center">
          <li>
            <div class="blockhp">
              <h3 class="title2-blockhp"><?php echo $lang['etape1']; ?>
                <!-- TELECHARGEZ L'APPLICATION ET DONNEZ VOTRE AVIS -->
              </h3>
              <p>
                <?php echo $lang['etape1explain']; ?>
                <!-- "Scannez le QR code pour passer à l'istalation de l'application." -->
              </p>
            </div>
          </li>

          <li>
            <img id="" src="assets/images/codeqr.png" alt="" width="250" height="">

            <p>https://i.diawi.com/t8RVRz</p>
          </li>
        </ul>
      </div>
      <div class="col-md-6">
        <div class="d-none d-lg-block">
          <!-- <img src="assets/images/about/videowgl.mp4" alt="appwebgl" />--->
          <video style="margin-top:60px;" class="videoapp" controls width="550" height="600">
            <source src="assets/images/about/videowgl.mp4" type="video/webm">
          </video>
        </div>
      </div>
    </div>
  </div>

</section>


<!-- ====== Features End ====== -->

<section id="features" class="ud-features">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="ud-section-title">

          <h2><?php echo $lang['regles']; ?>
            <!-- Les règles à respecter -->
          </h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-3">
        <div class="ud-single-feature wow fadeInUp" data-wow-delay=".1s">
          <div class="stylecontour">

            <img id="casqueimg" src="assets/images/caquemoto2.png" alt="about-image">

          </div>
          <div class="ud-feature-content">
            <h3 id="1b" class="ud-feature-title"><?php echo $lang['regle1']; ?>
              <!-- Portez un casque -->
            </h3>
            <p class="ud-feature-desc">

            </p>
            <a href="javascript:void(0)" class="ud-feature-link">

            </a>
          </div>
        </div>
      </div>
      <div class="col-xl-3">
        <div class="ud-single-feature wow fadeInUp" data-wow-delay=".15s">
          <div class="stylecontour">

            <img id="codeimg" src="assets/images/code de la route.jpeg" alt="about-image">

          </div>
          <div class="ud-feature-content">
            <h3 id="2b" class="ud-feature-title"><?php echo $lang['regle2']; ?>
              <!-- Respecter le code de la route -->
            </h3>
            <p class="ud-feature-desc">

            </p>
            <a href="javascript:void(0)" class="ud-feature-link">

            </a>
          </div>
        </div>
      </div>
      <div class="col-xl-3">
        <div class="ud-single-feature wow fadeInUp" data-wow-delay=".2s">
          <div class="stylecontour">

            <img id="stationimg" src="assets/images/stationscooter.webp" alt="about-image">

          </div>

          <div class="ud-feature-content">
            <h3 id="titlethree" class="ud-feature-title"><?php echo $lang['regle3']; ?>
              <!-- Stationner responsablement -->
            </h3>
            <p class="ud-feature-desc">

            </p>
            <a href="javascript:void(0)" class="ud-feature-link">

            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>









<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

<div class="row" id="contatti">
  <div class="container mt-5">

    <div class="row" style="height:550px;">
      <div class="col-md-6 maps">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d89077.1720074736!2d4.764918569449523!3d45.757929197827096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f4ea516ae88797%3A0x408ab2ae4bb21f0!2sLyon!5e0!3m2!1sfr!2sfr!4v1651402766452!5m2!1sfr!2sfr" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
      <div class="col-md-6">
        <h2 class="text-uppercase mt-3 font-weight-bold text-white">CONTACT</h2>
        <form action="">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <input type="text" class="form-control mt-2" placeholder="Nom" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="text" class="form-control mt-2" placeholder="Objet" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="email" class="form-control mt-2" placeholder="Email" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <input type="number" class="form-control mt-2" placeholder="Telephone" required>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="MESSAGE" rows="3" required></textarea>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                </div>
              </div>
            </div>
            <div class="col-12">
              <button class="btn btn-light" type="submit">Envoyer</button>
            </div>
          </div>
        </form>
        <div class="text-white">
          <h2 style="margin-top:25px;" class="text-uppercase mt-4 font-weight-bold">Contactez-nous</h2>

          <i class="fas fa-phone mt-3"></i> <a href="tel:+">(+33) 123456</a><br>
          <i class="fas fa-phone mt-3"></i> <a href="tel:+">(+33) 123456</a><br>
          <i class="fa fa-envelope mt-3"></i> <a href="">contact@agustingomezdeltoro.tech</a><br>
          <div class="my-4">
          </div>
        </div>
      </div>

    </div>
  </div>
</div>



</body>

</html>