<?php
session_start();
include "models/userModel.php";
$_SESSION['token'] = bin2hex(random_bytes(16));


/*
[lang] => fr
    [firstname] => Benito Silva
    [lastname] => Gustavo
    [email] => gutibs@gmail.com
    [phone] => 54960028405
    [pwd] => 123
    [forfait] => 1
    [forfait_code] => price_1LZObQEHBNXPszy0jFlNwXrI
    [token] => 936db03a53131fedf59096f3dddc7656
    */

/*
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
                                                */


$userModel->storeFormValues($_SESSION);
$user = $userModel->create_new_user();

if($_SESSION['forfait'] === "1"){$description = 'Forfait journalier pour 9,99€'; $amount = '9,99';}
if($_SESSION['forfait'] === "8"){$description = 'Forfait journalier pour 19,99€'; $amount = '19,99';}
if($_SESSION['forfait'] === "25"){$description = 'Forfait journalier pour 44,99€'; $amount = '44,99';}
if($_SESSION['forfait'] === "50"){$description = 'Forfait journalier pour 79,99€'; $amount = '79,99';}
if($_SESSION['forfait'] === "NA"){} else {
  $userModel->insert_payment($user,$description,$amount);
}




 $_SESSION['connect'] = 1; 
 $_SESSION['token'] = $_POST['token'];
 $_SESSION['user'] = $_POST['firstname'];
 $_SESSION['userId'] = $user;


header("location:users/home.php");
