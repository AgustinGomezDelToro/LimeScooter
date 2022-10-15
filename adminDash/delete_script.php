<?php
include("adminClass.php");

extract($_POST);

if($_POST['type'] === "product"){
$sql = "DELETE FROM products WHERE idProduct = $id";
$adm->do_this($sql);
}

if($_POST['type'] === "user"){
    $sql = "DELETE FROM users WHERE iduser = $id";
    $adm->do_this($sql);
    }
    