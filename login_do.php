<?php


include "models/userModel.php";
$userModel = new UserModel;



$userModel->storeFormValues($_POST);
$user = $userModel->login() ;

if($user){
    session_start();
   $_SESSION['connect'] = 1; 
   $_SESSION['token'] = $user->token;
   $_SESSION['user'] = $user->firstname;
   $_SESSION['userId'] = $user->idUser;
   
    header('location: users/home.php');
    exit();
    
} else {
     header('location: connexion.php?error=1');
    exit();
}
