<?php
session_start();
// Test si l'utilisateur est déjà connecté
if (isset($_SESSION['connect'])) {
    header('location:users/dash.php');
    exit();
}

include("fb.php");
include("include/app.php");
include("include/menu.php");

?>


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
                                            <input type="checkbox" name="connexion" checked>
                                            <label for="connexion">Mémoriser mes identifiants </label>
                                        </div>
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
