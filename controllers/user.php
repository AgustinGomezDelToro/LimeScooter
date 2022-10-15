<?php
session_start();
/*
Array
(
    [firstname] => Gustavo
    [lastname] => silva
    [email] => gutibs@gmail.com
    [phone] => 60028405
    [pwd] => asd
    [confirmpwd] => asd
    [forfait] => journalier

    Array
(
    [firstname] => Benito Silva
    [lastname] => Gustavo
    [email] => gutibs@gmail.com
    [phone] => 5491160028405
    [pwd] => 123
    [confirmpwd] => 123
    [forfait] => 1
)

)
*/

include "../models/userModel.php";


    
    if (trim($_POST['firstname']) === '') {
        $_SESSION['errors']['firstname'] = 1;
        header("location:../sign-up.php");
        exit;
    } 
    if (trim($_POST['lastname']) === '') {
        $_SESSION['errors']['lastname'] = 1;
        header("location:../sign-up.php");
        exit;
    }
    if (trim($_POST['phone']) === '') {
        $_SESSION['errors']['phone'] = 1;
        header("location:../sign-up.php");
        exit;
    }
    if ($_POST['pwd'] !== $_POST['confirmpwd']) {
        $_SESSION['errors']['pwd'] = 1;
        header("location:../sign-up.php");
        exit;
    } 
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors']['email'] = 1;
        header("location:../sign-up.php");
        exit;
    } 
    
    
    
        $userModel->storeFormValues($_POST);
        $already = $userModel->findByEmail();
   
        if ($already === "1") {
            $_SESSION['errors']['email'] = 1;
            header("location:../sign-up.php");
            exit;
        } 

       
        $_SESSION['firstname'] = $_POST['firstname'];
        $_SESSION['lastname'] = $_POST['lastname'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['phone'] = $_POST['phone'];
        $_SESSION['pwd'] = $_POST['pwd'];
        $_SESSION['forfait'] = $_POST['forfait'];
        
        if ($_POST['forfait'] === "1"){ $ff = 'price_1LZObQEHBNXPszy0jFlNwXrI'; }
        if ($_POST['forfait'] === "8"){ $ff = 'price_1LZObrEHBNXPszy0LCcjkLGR'; }
        if ($_POST['forfait'] === "25"){ $ff = 'price_1LZOcBEHBNXPszy0X1OAbKNk'; }
        if ($_POST['forfait'] === "50"){ $ff = 'price_1LZOcTEHBNXPszy0l30IwXHC'; }


        if ($_POST['forfait'] === "NA"){ header("location:../bienvenue.php"); exit;}
        

            
            $_SESSION['forfait_code'] = $ff; 
             header("location:../payment.php");
            exit;
       
    

exit;

if (isset($_POST["subject"], $_POST["id"])) {
    $id_user = $_POST["id"];
    $recupdonnee = $_POST["subject"];
    User::status($id_user, $recupdonnee);
}


if (isset($_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["phone"], $_POST["pwd"]) && count($_POST) == 5) {

    $email = strtolower(trim($_POST["email"]));
    $firstname = ucwords(strtolower(trim($_POST["firstname"])));
    $lastname = mb_strtoupper(trim($_POST["lastname"]));
    $phone = $_POST["phone"];
    $pwd = $_POST["pwd"];
    $status = "Admin";
    $newUser = User::addUser($firstname, $lastname, $phone, $email, $pwd, $status);
}

if (isset($_GET["delete"], $_GET["id"])) {
    $idScooter = $_GET["id"];
    $action = $_GET["delete"];
    Scooter::delete($idScooter);
}


class User
{
    /**
     * @example
     * User::get();
     */
    public static function get()
    {
        $users = UserModel::getAll();
        include __DIR__ . '/../view/adminDash/tables.php';
    }

    public static function status(int $id, int $recupdonnee): void
    {
        if ($recupdonnee == 3) {
            try {
                $status = UserModel::deleteUser($id);
                header("Location: ../usermana");
            } catch (PDOException $exception) {
                $exception->getMessage();
            }
        } else {
            try {
                $status = UserModel::updateOneById($id, ["state" => $recupdonnee]);
                header("Location: ../usermana");
            } catch (PDOException $exception) {
                $exception->getMessage();
            }
        }
    }

    public static function create(string $firstname, string $lastname, string $email, int $phone, string $pwd, string $pwdConfirm, string $forfait, string $status)
    {
        try {
            //nettoyer les données
            $email = strtolower(trim($email));
            $firstname = ucwords(strtolower(trim($firstname)));
            $lastname = mb_strtoupper(trim($lastname));
            //vérifier les données
            $errors = [];
            //Email OK
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Email incorrect";
            } else {

                //Vérification l'unicité de l'email
                $user = UserModel::findByEmail($email);
                if (!empty($user)) {
                    $errors[] = "L'email existe déjà en bdd";
                }
            }
            //prénom : Min 2, Max 45 ou empty
            if (strlen($firstname) == 1 || strlen($firstname) > 45) {
                $errors[] = "Votre prénom doit faire plus de 2 caractères";
            }

            //nom : Min 2, Max 100 ou empty
            if (strlen($lastname) == 1 || strlen($lastname) > 100) {
                $errors[] = "Votre nom doit faire plus de 2 caractères";
            }
            //Mot de passe : Min 8, Maj, Min et chiffre
            if (
                strlen($pwd) < 8 ||
                preg_match("#\d#", $pwd) == 0 ||
                preg_match("#[a-z]#", $pwd) == 0 ||
                preg_match("#[A-Z]#", $pwd) == 0
            ) {
                $errors[] = "Votre mot de passe doit faire plus de 8 caractères avec une minuscule, une majuscule et un chiffre";
            }
            //Confirmation : égalité
            if ($pwd != $pwdConfirm) {
                $errors[] = "Votre mot de passe de confirmation ne correspond pas";
            }
            //            if (!preg_match('/^0[1-68]([-. ]?[0-9]{2}){4}/', $phone)) {
            //                $errors[] = 'Numéro de téléphone pas valide';
            //            }
            //                //Vérification l'unicité de l'email
            $findPhone = UserModel::findByPhone($phone);
            if (!empty($findPhone)) {
                $errors[] = "Numéro de téléphone est déjà utilisé";
            }
            $pwd = password_hash($pwd, PASSWORD_DEFAULT);
            var_dump($errors);
            var_dump($_POST);
            if (count($errors) == 0) {
                $newUser = UserModel::create([
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "phone" => $phone,
                    "email" => $email,
                    "pwd" => $pwd,
                    "subscription" => $forfait,
                    "status_user" => $status
                ]);
                if ($newUser == 1) {
                    $result = UserModel::findByEmail($email);
                    if (!$result) {
                        $_SESSION["result"] = $result;
                        header("Location: sign-up");
                    } else {
                        $token = bin2hex(random_bytes(16));
                        $result = UserModel::updateOneById($result["idUser"], ["token" => $token]);
                        $user = UserModel::getOneByToken($token);
                        $_SESSION["user"] = $user;
                        header("Location: userprofil");
                    }
                }
            } else {
                $_SESSION["errors"] = $errors;
                header("Location: ../sign-up.php");
            }
        } catch (PDOException $exception) {
            $errors[] = $exception->getMessage();
            $_SESSION["errors"] = $errors;
            header("Location: ../sign-up.php");
        }
    }

    public static function addUser($firstname, $lastname, $phone, $email, $pwd, $status)
    {
        try {
            //nettoyer les données
            $email = strtolower(trim($email));
            $firstname = ucwords(strtolower(trim($firstname)));
            $lastname = mb_strtoupper(trim($lastname));
            //vérifier les données
            $errors = [];
            //Email OK
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Email incorrect";
            } else {

                //Vérification l'unicité de l'email
                $user = UserModel::findByEmail($email);
                if (!empty($user)) {
                    $errors[] = "L'email existe déjà ";
                }
            }
            //Mot de passe : Min 8, Maj, Min et chiffre
            if (
                strlen($pwd) < 8 ||
                preg_match("#\d#", $pwd) == 0 ||
                preg_match("#[a-z]#", $pwd) == 0 ||
                preg_match("#[A-Z]#", $pwd) == 0
            ) {
                echo $pwd;
                $errors[] = "Votre mot de passe doit faire plus de 8 caractères avec une minuscule, une majuscule et un chiffre";
            }

            //            if (!preg_match('/^0[1-68]([-. ]?[0-9]{2}){4}/', $phone)) {
            //                $errors[] = 'Numéro de téléphone pas valide';
            //            }
            //                //Vérification l'unicité de l'email
            $findPhone = UserModel::findByPhone($phone);
            if (!empty($findPhone)) {
                $errors[] = "Numéro de téléphone est déjà utilisé";
            }
            $pwd = password_hash($pwd, PASSWORD_DEFAULT);

            if (count($errors) == 0) {
                $newUser = UserModel::addUser([
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "phone" => $phone,
                    "email" => $email,
                    "passwd" => $pwd,
                    "status_user" => $status,
                ]);
                if ($newUser == 1) {
                    $result = UserModel::findByEmail($email);
                    if (!$result) {
                        $_SESSION["result"] = $result;
                    } else {
                        $token = bin2hex(random_bytes(16));
                        $result = UserModel::updateOneById($result["idUser"], ["token" => $token]);
                        $user = UserModel::getOneByToken($token);
                        $_SESSION["user"] = $user;
                    }
                    header("Location: tables");
                }
            } else {
                $_SESSION["errors"] = $errors;
                header("Location: tables");
            }
        } catch (PDOException $exception) {
            $errors[] = $exception->getMessage();
            $_SESSION["errors"] = $errors;
            header("Location: tables");
        }
    }
}
