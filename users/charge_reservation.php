<?php
session_start();
require("../../vendor/autoload.php");
$i = json_decode($_GET['data']);

/*
Array
(
    [data] => {"scooter":"337","origin_lat":"45.7995","origin_lng":"4.821","destination_lat":45.78221985436383,"destination_lng":4.82952117919922,"reservation_distance":"5.29","userId":"104","cost":3.5300000000000002}
)
stdClass Object
(
    [scooter] => 337
    [origin_lat] => 45.7995
    [origin_lng] => 4.821
    [destination_lat] => 45.782219854364
    [destination_lng] => 4.8295211791992
    [reservation_distance] => 5.29
    [userId] => 104
    [cost] => 3.53
)

*/

$_SESSION['reservation']['scooter'] = $i->scooter;
$_SESSION['reservation']['origin_lat'] = $i->origin_lat;
$_SESSION['reservation']['origin_lng'] = $i->origin_lng;
$_SESSION['reservation']['destination_lat'] = $i->destination_lat;
$_SESSION['reservation']['destination_lng'] = $i->destination_lng;
$_SESSION['reservation']['reservation_distance'] = $i->reservation_distance;
$_SESSION['reservation']['userId'] = $i->userId;
$_SESSION['reservation']['cost'] = $i->cost;


$stripe = new \Stripe\StripeClient(
    'sk_test_51LZMUJEHBNXPszy0lG6W7Rrf3oe0MQNOnCLyRgGL1PxFrQPhTChe5EeQfg2Xrut4bXUNd845la4iiPaeX6TJOYC200SksftfhE'
  );

$ncost = $i->cost * 100;

  $price_id = $stripe->prices->create([
    'unit_amount' => $ncost,
    'currency' => 'eur',
    'product' => 'prod_MKSp43Gag3GgkH',
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
    'success_url' => $YOUR_DOMAIN . 'users/one_voyage_success.php',
    'cancel_url' => $YOUR_DOMAIN . 'users/one_voyage_refuse.php',
  ]);
  
  header("HTTP/1.1 303 See Other");
  header("Location: " . $checkout_session->url);
  