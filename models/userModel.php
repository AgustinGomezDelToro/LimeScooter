<?php
include __DIR__ . "/../database/setting.php";


class UserModel
{

    public function storeFormValues($params)
    {
        $this->__construct($params);
    }

    public function __construct($data = array())
    {

        if (isset($data['firstname'])) {
            $this->firstname = stripslashes(strip_tags($data['firstname']));
        }
        if (isset($data['lastname'])) {
            $this->lastname = stripslashes(strip_tags($data['lastname']));
        }
        if (isset($data['email'])) {
            $this->email = stripslashes(strip_tags($data['email']));
        }
        if (isset($data['phone'])) {
            $this->phone = stripslashes(strip_tags($data['phone']));
        }
        if (isset($data['pwd'])) {
            $this->pwd = stripslashes(strip_tags($data['pwd']));
        }
        if (isset($data['forfait'])) {
            $this->forfait = stripslashes(strip_tags($data['forfait']));
        }
        if (isset($data['token'])) {
            $this->token = stripslashes(strip_tags($data['token']));
        }
        if (isset($data['password'])) {
            $this->password = stripslashes(strip_tags($data['password']));
        }
        if (isset($data['idUser'])) { $this->idUser = stripslashes(strip_tags($data['idUser'])); }
        if (isset($data['address'])) { $this->address = stripslashes(strip_tags($data['address'])); }
    }


    public function update_user(){
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE users SET firstname = :firstname,
                                             lastname = :lastname,
                                             phone = :phone,
                                             email = :email,
                                             address = :address WHERE idUser = $this->idUser";
            $stmt = $con->prepare($sql);
            $stmt->bindValue("firstname", $this->firstname, PDO::PARAM_STR);
            $stmt->bindValue("lastname", $this->lastname, PDO::PARAM_STR);
            $stmt->bindValue("email", $this->email, PDO::PARAM_STR);
            $stmt->bindValue("phone", $this->phone, PDO::PARAM_STR);
            $stmt->bindValue("address", $this->address, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "create_new_user error";
        }
    }
/*
Array
(
    [idUser] => 107
    [firstname] => Benito Silva
    [lastname] => Gustavo
    [phone] => 5496002840
    [email] => gutibs@gmail.com
    [address] => quintana 1906
)

*/

public function get_this_client_payments(){
    $user = $_SESSION['userId'];
   
    $sql = "SELECT * FROM payments WHERE idUser = $user";
    return self::get_This_all($sql);
}

public function get_this_client_purchases(){
    $user = $_SESSION['userId'];
   
    $sql = "SELECT * FROM purchase WHERE idUser = $user";
    return self::get_This_all($sql);
}

public function get_this_user_rides(){
    $user = $_SESSION['userId'];

    $sql = "SELECT * FROM rides WHERE idUser = $user";
    
    return self::get_this_all($sql);
}

    public function get_details(){
        $user = $_SESSION['userId'];
        $sql = "SELECT points, wallet, subscription FROM users WHERE idUser = $user";
        $udat = self::get_this_1($sql);

        $sql = "SELECT COUNT(*) as total_rides FROM rides WHERE idUser = $user AND status = 2";
        $rides = self::get_this_1($sql);

        $res = array("user" => $udat,"rides" => $rides);
        return $res;
    }

    public function get_this_user(){
        $user = $_SESSION['userId'];
        $sql = "SELECT * FROM users WHERE idUser = $user";
        return self::get_this_1($sql);
    }
    /*
    [firstname] => Gustavo
    [lastname] => silva
    [email] => gutibs@gmail.com
    [phone] => 60028405
    [pwd] => asd
    [confirmpwd] => asd
    [forfait] => journalier
     * 
     *  [email] => gutibs@gmail.com
    [password] => 123
    [connexion] => on
)
*/

public function insert_payment($user,$description,$amount){
    $sql = "INSERT INTO payments SET idUser = $user, concept = '$description', amount = '$amount', date_action = NOW()";
    self::do_this($sql);
}

    public function findByEmail()
    {
        $sql = "SELECT COUNT(*) as already FROM users WHERE email = '$this->email'";
        return self::get_this_1($sql);
    }

    public function create_new_user()
    {
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO users SET firstname = :firstname,
                                             lastname = :lastname,
                                             phone = :phone,
                                             email = :email,
                                             token = :token,
                                             status_user = 'Clients',
                                             subscription = :forfait,
                                             passwd  = AES_ENCRYPT(:pwd, '" . PWHASH . "')";
            $stmt = $con->prepare($sql);
            $stmt->bindValue("firstname", $this->firstname, PDO::PARAM_STR);
            $stmt->bindValue("lastname", $this->lastname, PDO::PARAM_STR);
            $stmt->bindValue("email", $this->email, PDO::PARAM_STR);
            $stmt->bindValue("phone", $this->phone, PDO::PARAM_STR);
            $stmt->bindValue("token", $this->token, PDO::PARAM_STR);
            $stmt->bindValue("pwd", $this->pwd, PDO::PARAM_STR);
            $stmt->bindValue("forfait", $this->forfait, PDO::PARAM_STR);
            $stmt->execute();
            return $con->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "create_new_user error";
        }
    }


    public function login()
    {
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT idUser, firstname, token FROM users WHERE email = :email AND passwd  = AES_ENCRYPT(:password, '" . PWHASH . "') ";
            $stmt = $con->prepare($sql);
            $stmt->bindValue("email", $this->email, PDO::PARAM_STR);
            $stmt->bindValue("password", $this->password, PDO::PARAM_STR);
            $stmt->execute();
            $valid = $stmt->fetch(PDO::FETCH_OBJ);
            return $valid;
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "login function error";
        }
    }


    public function do_this($sql)
    {
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $con->prepare($sql);
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "doThis error";
            echo $sql . "<br>";
        }
    }

    public function get_this_1($sql)
    {
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $valid = $stmt->fetch(PDO::FETCH_OBJ);
            return $valid;
        } catch (PDOException $e) {
            // echo $e->getMessage();
            // echo $sql;
            return 0;
        }
    }

    public function get_this_all($sql)
    {
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $valid = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $valid;
        } catch (PDOException $e) {
            // echo $e->getMessage();
            // echo $sql;
            return 0;
        }
    }

    public function insert_return_last_id($sql)
    {
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $con->prepare($sql);
            $stmt->execute();
            return $con->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "laconcw";
            echo $sql;
        }
    }
}

$userModel = new UserModel;


class UserModelVieja
{
    public static function getAll()
    {
        $databaseConnection = DatabaseSettings::getConnection();
        $getUsersQuery = $databaseConnection->query("SELECT idUser, firstname, lastname, phone, email, status_user, address, zipcode, birthdate, points, wallet, state FROM users;");
        return $getUsersQuery->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($createUser): int
    {
        $databaseConnection = DatabaseSettings::getConnection();
        $createUserQuery = $databaseConnection->prepare("INSERT INTO users(firstname,lastname, phone, email,passwd, status_user,subscription) VALUES(:firstname,:lastname, :phone, :email,:pwd, :status_user, :subscription);");
        $createUserQuery->execute($createUser);
        return 1;
    }



    public static function findByEmail(string $email)
    {
        $databaseConnection = DatabaseSettings::getConnection();
        $getUserQuery = $databaseConnection->prepare("SELECT * FROM users WHERE email = :email");
        $getUserQuery->execute([
            "email" => $email
        ]);
        return $getUserQuery->fetch(PDO::FETCH_ASSOC);
    }

    public static function getOneByToken($token)

    {
        $databaseConnection = DatabaseSettings::getConnection();
        $query = $databaseConnection->prepare("SELECT * FROM users WHERE token = :token");
        $query->execute([
            "token" => $token
        ]);
        return $query->fetch();
    }

    public static function findByPhone(int $phone)
    {
        $databaseConnection = DatabaseSettings::getConnection();
        $getUserQuery = $databaseConnection->prepare("SELECT * FROM users WHERE phone = :phone");
        $getUserQuery->execute([
            "phone" => $phone
        ]);
        return $getUserQuery->fetch();
    }

    public static function deleteUser(int $id): string
    {
        echo $id;
        $databaseConnection = DatabaseSettings::getConnection();
        echo "bdd ok";
        $deleteUsersQuery = $databaseConnection->prepare("DELETE FROM users WHERE idUser =:id");
        $deleteUsersQuery->execute(["id" => $id]);
        return $info = "L'utilisateur a bien été supprimé";
    }

    public static function logout()
    {
        unset($_SESSION["info"]);
        session_destroy();
    }


    public static function  updateOneById($id, $user)
    {
        $set = [];
        $allowedKeys = ["firstname", "lastname", "phone", "email", "passwd", "status_user", "address", "points", "wallet", "birthdate", "zipcode", "state", "check", "token"];
        foreach ($user as $key => $value) {
            if (!in_array($key, $allowedKeys)) {
                continue;
            }
            $set[]  = "$key = :$key";
        }
        $set = implode(",", $set);
        $databaseConnection = DatabaseSettings::getConnection();
        $updateUsersQuery = $databaseConnection->prepare("UPDATE users SET $set WHERE idUser =:id");
        return $updateUsersQuery->execute(array_merge(["id" => $id], $user));
    }
    public static function addUser($user)
    {
        $set = [];
        $set2 = [];
        $allowedKeys = ["firstname", "lastname", "phone", "email", "passwd", "status_user", "address", "points", "wallet", "birthdate", "zipcode", "state", "check", "token"];
        foreach ($user as $key => $value) {
            echo $key;
            if (!in_array($key, $allowedKeys)) {
                continue;
            }
            $set[]  = ":$key";
            $set2[]  = "$key";
        }
        $set = implode(",", $set);
        $set2 = implode(",", $set2);
        echo $set2;
        $databaseConnection = DatabaseSettings::getConnection();
        $updateUsersQuery = $databaseConnection->prepare("INSERT INTO users($set2) VALUES($set);");
        return $updateUsersQuery->execute($user);

        //        scooterModel::addScooter($number,$condition,$status,$workzoneLabel);
        header("Location: ../tables");
    }
}
