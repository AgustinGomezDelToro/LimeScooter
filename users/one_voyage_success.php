<?php
session_start();
include("mapping/map_class.php");

extract($_SESSION['reservation']);

  $res = $mp->set_reservation($scooter,$origin_lat,$origin_lng,$userId,$destination_lat,$destination_lng, $reservation_distance);
 
  $new_loc = $mp->set_new_location($scooter,$destination_lat,$destination_lng);

header("location:home.php");