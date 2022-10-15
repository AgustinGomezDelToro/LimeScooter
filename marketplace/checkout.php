<?php
session_start();
require("../../vendor/autoload.php");


/*

//Array ( [products] => 5 [total] => 141 ) 

*/

$_SESSION['total_products'] = $_POST['products'];
$_SESSION['total_payment'] = $_POST['total'];

$stripe = new \Stripe\StripeClient(
    'sk_test_51LZMUJEHBNXPszy0lG6W7Rrf3oe0MQNOnCLyRgGL1PxFrQPhTChe5EeQfg2Xrut4bXUNd845la4iiPaeX6TJOYC200SksftfhE'
  );

$ncost = $_POST['total'] * 100;

  $price_id = $stripe->prices->create([
    'unit_amount' => $ncost,
    'currency' => 'eur',
    'product' => 'prod_MLhrFyd4FsatIh',
  ]);

  $new_price = $price_id->id;

  header('Content-Type: application/json');

  $YOUR_DOMAIN = 'https://agustingomezdeltoro.tech/tino/';
  


  \Stripe\Stripe::setApiKey('sk_test_51LZMUJEHBNXPszy0lG6W7Rrf3oe0MQNOnCLyRgGL1PxFrQPhTChe5EeQfg2Xrut4bXUNd845la4iiPaeX6TJOYC200SksftfhE');



  $checkout_session = \Stripe\Checkout\Session::create([
    'line_items' => [[
      'price' => $new_price,
      'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . 'marketplace/success.php',
    'cancel_url' => $YOUR_DOMAIN . 'marketplace/index.php',
  ]);
  
  header("HTTP/1.1 303 See Other");
  header("Location: " . $checkout_session->url);
  
