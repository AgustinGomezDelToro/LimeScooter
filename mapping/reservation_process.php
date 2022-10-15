<?php
include("map_class.php");

echo json_encode($_POST);
exit;
extract($_POST);

$res = $mp->set_reservation($scooter,$origin_lat,$origin_lng,$userId);

echo json_encode($res);