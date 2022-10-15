<?php 
session_start();
include "../controllers/Token.php";
//var_dump($_POST); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    Soft UI Dashboard by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.5" rel="stylesheet" />
</head>

<body>
<main class="main-content  mt-0">
    <section>
        <div class="page-header ">
            <div class="container">
                <div class="row mt-3">
                    <div class="col">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left bg-transparent">
                                <h3 class="font-weight-bolder text-info text-gradient">Connexion</h3>

                            </div>
                            <div class="card-body">

                                <p> Bienvenue sur le site, pour en voir plus, merci de vous connecter. Si vous n'êtes par encore connecté, <a href="sign-up.php"> inscrivez-vous </a>.</p>
                                <?php
                                // Contrôle des erreurs
                                if (isset($_GET['error'])) {
                                    echo '<p class="alert alert-warning" role="alert"><i class="fas fa-info-circle"></i> Veuillez vérifier vos informations ou vous inscrire. </p>';
                                }
                                ?>    
                                <form method="POST" action="login_do.php">
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="name">Email :</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                                        </div>
                                        <div class="form-group col">
                                            <label for="password">Mot de passe :</label>
                                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <button type="submit" class="btn btn-primary">Se connecter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</main>
 
</body>

</html>