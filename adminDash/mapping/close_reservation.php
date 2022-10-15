<?php
include("map_class.php");
extract($_POST);

$res = $mp->close_reservation($idRide);

echo json_encode($res);