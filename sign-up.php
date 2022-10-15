<?php
include("fb.php");
include("include/app.php");
include("include/menu.php");
if(isset($_SESSION['errors']['firstname'])){ $firstname_error = 'is-invalid'; } else { $firstname_error = ''; }
if(isset($_SESSION['errors']['lastname'])){ $lastname_error = 'is-invalid'; } else { $lastname_error = ''; }
if(isset($_SESSION['errors']['phone'])){ $phone_error = 'is-invalid'; } else { $phone_error = ''; }
if(isset($_SESSION['errors']['pwd'])){ $pwd_error = 'is-invalid'; } else { $pwd_error = ''; }
if(isset($_SESSION['errors']['email'])){ $email_error = 'is-invalid'; } else { $email_error = ''; }
if(isset($_SESSION['errors']['user_exists'])){ $user_exists_error = 'is-invalid'; } else { $user_exists_error = ''; }

?>

<main class="main-content  mt-0">
    <section>
        <div class="page-header ">
            <div class="container">
                <div class="row mt-3">
                    <div class="col">
                        <div class="card card-plain mt-8">
                            <div class="card-header pb-0 text-left bg-transparent">
                                <h3 class="font-weight-bolder text-info text-gradient">Inscription</h3>
                                <p class="mb-0">Enter your email and password to sign in</p>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="controllers/user.php">
                                   
                                    <label>Prénom</label>
                                    <div class="mb-3">
                                        <input type="text" class="form-control <?php echo $firstname_error;?>" placeholder="Prenom" name="firstname" aria-label="firstname" aria-describedby="firstname-addon">
                                    </div>
                                    <label>Nom</label>
                                    <div class="mb-3">
                                        <input type="text" class="form-control <?php echo $lastname_error;?>" placeholder="Nom" name="lastname" aria-label="lastname" aria-describedby="lastname-addon">
                                    </div>
                                    <label>Email</label>
                                    <div class="mb-3">
                                        <input type="email" class="form-control <?php echo $email_error;?>" placeholder="Email" name="email" aria-label="email" aria-describedby="email-addon">
                                    </div>
                                    <label>Téléphone</label>
                                    <div class="mb-3">
                                        <input type="tel" class="form-control <?php echo $phone_error;?>" placeholder="Phone" name="phone" aria-label="phone" aria-describedby="phone-addon">
                                    </div>
                                    <label>Mot de passe</label>
                                    <div class="mb-3">
                                        <input type="password" class="form-control <?php echo $pwd_error;?>" placeholder="Mot de passe" aria-label="pwd" aria-describedby="pwd-addon" name="pwd">
                                    </div>

                                    <label>Confirmation de mot de passe</label>
                                    <div class="mb-3">
                                        <input type="password" class="form-control <?php echo $pwd_error;?>" placeholder="Mot de passe" aria-label="Password" aria-describedby="pwd-addon" name="confirmpwd">
                                    </div>
                                    <label>Souscrire à un abonnement </label>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" checked name="forfait" value="1" id="customRadio2">
                                                    <label class="custom-control-label"  for="customRadio2">forfait journalier pour 9,99€</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="forfait" value="8" id="customRadio2">
                                                    <label class="custom-control-label" for="customRadio2">8 trajets pour 19,99€</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="forfait" value="25" id="customRadio2">
                                                    <label class="custom-control-label" for="customRadio2">25 trajets pour 44,99€</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="forfait" value="50" id="customRadio2">
                                                    <label class="custom-control-label" for="customRadio2">50 trajets pour 79,99€</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="forfait" value="NA" id="customRadio2">
                                                    <label class="custom-control-label" for="customRadio2">Aucun abonnement</label>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info w-100 mt-4 mb-0">S'inscrire</button>
                                    </div>
                                    <div class="card-footer text-center pt-0 px-lg-2 px-1" <p class="mb-4 text-sm mx-auto">
                                        J'ai un compte.
                                        <a href="sign-up" class="text-info text-gradient font-weight-bold">Se connecter</a>
                                        </p>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                        <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>
