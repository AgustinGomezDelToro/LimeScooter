<?php
include("map_class.php");

extract($_POST);

  $res = $mp->set_reservation($scooter,$origin_lat,$origin_lng,$userId,$destination_lat,$destination_lng, $reservation_distance);
 
  $new_loc = $mp->set_new_location($scooter,$destination_lat,$destination_lng);

echo json_encode($res);