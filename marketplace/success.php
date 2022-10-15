<?php
session_start();
extract($_SESSION);
include("marketplace_class.php");
$hoy = date('Y-m-d');

$sql = "INSERT INTO purchase SET idUser = $userId, amount_products = $total_products, amount_purchase = $total_payment, date_purchase = '$hoy'";

$mkt->do_this($sql);

header("location:../users/home.php");
