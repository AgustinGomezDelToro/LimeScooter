<?php
include "adminClass.php";


$tim = time();

if (isset($_FILES['images']) && $_FILES['images']['size'] != 0) {

    $path = $_FILES['images']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $fname = "scooter".$tim .".". $ext;
    $_POST['images'] = $fname;
    move_uploaded_file($_FILES['images']['tmp_name'], '../scooter_images/' .  $fname);  
} 


$adm->storeFormValues($_POST);
$product_id = $adm->add_scooter();


header("location:scooters.php");