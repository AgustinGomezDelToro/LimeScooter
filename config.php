<?php
$host_name = 'localhost';
$database = 'u453178966_easy_scooter';
$user_name = 'u453178966_easy_scooter_u';
$password = 'm]AK4ACdc8';
$dbh = null;

	try {
        $dbh = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
	} catch (PDOException $e) {
        echo "Erreur!: " . $e->getMessage() . "<br/>";
	die();
    }
    
?>