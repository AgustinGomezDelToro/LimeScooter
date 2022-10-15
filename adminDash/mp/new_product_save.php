<?php
include("php/config.php");
include("php/arbor_class.php");
include("plugins/qr/qrlib.php");
$tim = time();

if (isset($_FILES['product_image']) && $_FILES['product_image']['size'] != 0) {

    $path = $_FILES['product_image']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $fname = "product_".$tim .".". $ext;
    $_POST['product_image'] = $fname;
    move_uploaded_file($_FILES['product_image']['tmp_name'], '../product_images/' .  $fname);  
} 


$arbor->storeFormValues($_POST);
$product_id = $arbor->add_product();

if($_POST['qr_text'] !== ''){
    $qr_text = $_POST['qr_text'];
} else {
    $qr_text = 'not defined';
}

QRcode::png($qr_text, '../product_images/qr_'.$product_id.'.png');

header("location:marketplace.php");
/*
Array
(
    [product_name] => testing product
    [product_sdg] => 2
    [unlock_shares] => 125
    [product_description] => sdfsdfsfdsdf
    [qr_text] => some text for the QR code
)
Array
(
    [product_image] => Array
        (
            [name] => Screenshot from 2022-06-14 10-59-42.png
            [type] => image/png
            [tmp_name] => /tmp/phpMsX3OL
            [error] => 0
            [size] => 15174
        )

)
*/