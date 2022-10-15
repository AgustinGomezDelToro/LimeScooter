<?php
include "adminClass.php";


$tim = time();

if (isset($_FILES['picture']) && $_FILES['picture']['size'] != 0) {

    $path = $_FILES['picture']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $fname = "product_".$tim .".". $ext;
    $_POST['picture'] = $fname;
    move_uploaded_file($_FILES['picture']['tmp_name'], '../product_images/' .  $fname);  
} 


$adm->storeFormValues($_POST);
$product_id = $adm->add_product();


header("location:marketplace.php");
