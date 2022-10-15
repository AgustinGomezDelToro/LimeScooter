<?php
session_start();
unset($_SESSION['reservation']);
header("location:home.php");