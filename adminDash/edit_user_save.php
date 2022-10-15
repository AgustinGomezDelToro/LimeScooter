<?php
include("adminClass.php");


extract($_POST);

$sql = "UPDATE users SET firstname = '$firstname',
                         lastname = '$lastname',
                         email = '$email',
                         phone = '$phone',
                         address = '$address',
                         zipcode = '$zipcode',
                         points = '$points',
                         wallet = '$wallet',
                         birthdate = '$birthdate',
                         state = '$state'
                WHERE idUser = $idUser";

                $adm->do_this($sql);

                header("location:users.php");