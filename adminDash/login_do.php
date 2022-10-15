<?php
include "adminClass.php";

$adm->storeFormValues($_POST);

$admin = $adm->login() ;

if($admin){
    session_start();
   $_SESSION['connect'] = 1; 
   $_SESSION['token'] = $admin->token;
   $_SESSION['user'] = $admin->firstname;
   $_SESSION['userId'] = $admin->idUser;
   
    header('location: home.php');
    exit();
    
} else {
     header('location: connexion.php?error=1');
    exit();
}
