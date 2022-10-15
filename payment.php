<?php
require("../vendor/autoload.php");
session_start();

$forfait = $_SESSION['forfait_code'];

\Stripe\Stripe::setApiKey('sk_test_51LZMUJEHBNXPszy0lG6W7Rrf3oe0MQNOnCLyRgGL1PxFrQPhTChe5EeQfg2Xrut4bXUNd845la4iiPaeX6TJOYC200SksftfhE');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'https://agustingomezdeltoro.tech/tino/';

$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [[
    'price' => $forfait,
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . 'success.php',
  'cancel_url' => $YOUR_DOMAIN . 'refuse.php',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
