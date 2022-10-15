<?php
session_start();
include("../models/userModel.php");
$userModel->storeFormValues($_POST);

$userModel->update_user();

header("location: home.php");

