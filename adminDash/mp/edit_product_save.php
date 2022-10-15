<?php
include("php/config.php");
include("php/arbor_class.php");
include("plugins/qr/qrlib.php");
$tim = time();



$arbor->storeFormValues($_POST);
$arbor->edit_product();

if (isset($_FILES['product_image']) && $_FILES['product_image']['size'] != 0) {

    $path = $_FILES['product_image']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $fname = "product_".$tim .".". $ext;
    $_POST['product_image'] = $fname;
    move_uploaded_file($_FILES['product_image']['tmp_name'], '../product_images/' .  $fname);  
    $arbor->storeFormValues($_POST);
    $arbor->edit_product_image();
} 

if($_POST['qr_text'] !== ''){
    $qr_text = $_POST['qr_text'];
} else {
    $qr_text = 'not defined';
}

QRcode::png($qr_text, '../product_images/qr_'.$_POST['product_id'].'.png');

header("location:marketplace.php");