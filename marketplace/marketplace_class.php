<?php
include __DIR__ . "/../database/setting.php";


class marketModel
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

        if (isset($data['name'])) { $this->name = stripslashes(strip_tags($data['name'])); }
        if (isset($data['price_product'])) { $this->price_product = stripslashes(strip_tags($data['price_product'])); }
        if (isset($data['price_order'])) { $this->price_order = stripslashes(strip_tags($data['price_order'])); }
        if (isset($data['vat'])) { $this->vat = stripslashes(strip_tags($data['vat'])); }
        if (isset($data['quantity'])) { $this->quantity = stripslashes(strip_tags($data['quantity'])); }
        if (isset($data['product_description'])) { $this->product_description = stripslashes(strip_tags($data['product_description'])); }
        if (isset($data['category'])) { $this->category = stripslashes(strip_tags($data['category'])); }
        if (isset($data['tag'])) { $this->tag = stripslashes(strip_tags($data['tag'])); }
        if (isset($data['weight'])) { $this->weight = stripslashes(strip_tags($data['weight'])); }
        if (isset($data['picture'])) { $this->picture = stripslashes(strip_tags($data['picture'])); }
        if (isset($data['idProduct'])) { $this->idProduct = stripslashes(strip_tags($data['idProduct'])); }
        if (isset($data['number'])) { $this->number = stripslashes(strip_tags($data['number'])); }
        if (isset($data['km'])) { $this->km = stripslashes(strip_tags($data['km'])); }
        if (isset($data['location'])) { $this->location = stripslashes(strip_tags($data['location'])); }
        if (isset($data['status'])) { $this->status = stripslashes(strip_tags($data['status'])); }
        if (isset($data['workzone'])) { $this->workzone = stripslashes(strip_tags($data['workzone'])); }
        if (isset($data['images'])) { $this->images = stripslashes(strip_tags($data['images'])); }
        if (isset($data['idScooter'])) { $this->idScooter = stripslashes(strip_tags($data['idScooter'])); }
        if (isset($data['condition'])) { $this->condition = stripslashes(strip_tags($data['condition'])); }

    }

    public function get_this_payment($idPayment){
        $sql = "SELECT a.*, b.firstname,b.lastname FROM payments a JOIN users b ON a.idUser = b.idUser WHERE a.idPayment = $idPayment";
        return self::get_this_1($sql);
    }

    public function get_this_client_payments($us){
        $sql = "SELECT * FROM payments WHERE idUser = $us";
        return self::get_This_all($sql);
    }

    public function get_this_client_rides($us){
        $sql = "SELECT * FROM rides WHERE idUser = $us";
        return self::get_this_all($sql);
    }


    public function get_this_client($us){
        $sql = "SELECT * FROM users WHERE idUser = $us";
        return self::get_this_1($sql);    
    }

public function get_users(){
    $sql = "SELECT * FROM users WHERE 1";
    return self::get_this_all($sql);
}

public function get_this_product($product_id){
    $sql = "SELECT * FROM products WHERE idProduct = $product_id";
return self::get_this_1($sql);
}

public function edit_product(){
    try {
        $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE products SET name = :name,
                                    price_product = :price_product,
                                    vat = :vat,
                                    price_order = :price_order,
                                    quantity  = :quantity,
                                    description = :product_description,
                                    category = :category,
                                    tag = :tag,
                                    weight = :weight
                                WHERE idProduct = $this->idProduct";

        $stmt = $con->prepare($sql);
        $stmt->bindValue("name", $this->name, PDO::PARAM_STR);
        $stmt->bindValue("price_product", $this->price_product, PDO::PARAM_STR);
        $stmt->bindValue("vat", $this->vat, PDO::PARAM_STR);
        $stmt->bindValue("price_order", $this->price_order, PDO::PARAM_STR);
        $stmt->bindValue("quantity", $this->quantity, PDO::PARAM_STR);
        $stmt->bindValue("product_description", $this->product_description, PDO::PARAM_STR);
        $stmt->bindValue("category", $this->category, PDO::PARAM_STR);
        $stmt->bindValue("tag", $this->tag, PDO::PARAM_STR);
        $stmt->bindValue("weight", $this->weight, PDO::PARAM_STR);

        $stmt->execute();

    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "login function error";
    }
}

public function edit_scooter_image(){
    try {
        $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE scooters SET images = :images
                                WHERE idScooter = $this->idScooter";

        $stmt = $con->prepare($sql);
        $stmt->bindValue("images", $this->images, PDO::PARAM_STR);

        $stmt->execute();
    
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "login function error";
    }
}


public function edit_product_image(){
    try {
        $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE products SET picture = :picture
                                WHERE idProduct = $this->idProduct";

        $stmt = $con->prepare($sql);
        $stmt->bindValue("picture", $this->picture, PDO::PARAM_STR);

        $stmt->execute();
    
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "login function error";
    }
}
public function edit_scooter(){

    try {
        $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE scooters SET `number` = :number_scooter,
                                     km = :km,
                                     `condition` = :condition,
                                     `status`  = :status
                                WHERE idScooter = $this->idScooter
                                         ";
                                      
        $stmt = $con->prepare($sql);
        $stmt->bindValue("number_scooter", $this->number, PDO::PARAM_STR);
        $stmt->bindValue("km", $this->km, PDO::PARAM_STR);
        $stmt->bindValue("condition", $this->condition, PDO::PARAM_STR);
        $stmt->bindValue("status", $this->status, PDO::PARAM_STR);
        $stmt->execute();
        return $con->lastInsertId();
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "login function error";
    }
}

public function add_scooter(){

    try {
        $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO scooters SET `number` = :number_scooter,
                                         `condition` = 1,
                                         km = :km,
                                         `status`  = 1,
                                         workzone = 'Nation',
                                         cur_lat = '45.75742280160704',
                                         cur_lng = '4.832143344670868',
                                         images = :images";
                                      
        $stmt = $con->prepare($sql);
        $stmt->bindValue("number_scooter", $this->number, PDO::PARAM_STR);
        $stmt->bindValue("km", $this->km, PDO::PARAM_STR);
        $stmt->bindValue("images", $this->images, PDO::PARAM_STR);
        $stmt->execute();
        return $con->lastInsertId();
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "login function error";
    }
}
public function add_product(){
    try {
        $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO products SET name = :name,
                                         price_product = :price_product,
                                         vat = :vat,
                                         price_order = :price_order,
                                         quantity  = :quantity,
                                         description = :product_description,
                                         category = :category,
                                         tag = :tag,
                                         weight = :weight,
                                         picture = :picture";
        $stmt = $con->prepare($sql);
        $stmt->bindValue("name", $this->name, PDO::PARAM_STR);
        $stmt->bindValue("price_product", $this->price_product, PDO::PARAM_STR);
        $stmt->bindValue("vat", $this->vat, PDO::PARAM_STR);
        $stmt->bindValue("price_order", $this->price_order, PDO::PARAM_STR);
        $stmt->bindValue("quantity", $this->quantity, PDO::PARAM_STR);
        $stmt->bindValue("product_description", $this->product_description, PDO::PARAM_STR);
        $stmt->bindValue("category", $this->category, PDO::PARAM_STR);
        $stmt->bindValue("tag", $this->tag, PDO::PARAM_STR);
        $stmt->bindValue("weight", $this->weight, PDO::PARAM_STR);
        $stmt->bindValue("picture", $this->picture, PDO::PARAM_STR);
        $stmt->execute();
        return $con->lastInsertId();
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "login function error";
    }

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
    
    public function findByEmail()
    {
        $sql = "SELECT COUNT(*) as already FROM users WHERE email = '$this->email'";
        return self::get_this_1($sql);
    }

    public function create_new_user()
    {
        $token = bin2hex(random_bytes(16));
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO users SET firstname = 'Agustin',
                                             lastname = 'Gomez',
                                             phone = '',
                                             email = 'agustinngomezdeltoro@gmail.com',
                                             token = '$token',
                                             status_user = 'Admin',
                                             subscription = '',
                                             passwd  = AES_ENCRYPT('123', '" . PWHASH . "')";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            return $con->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "create_new_user error";
        }
    }

public function get_products(){
$sql = "SELECT * FROM products WHERE 1";
return self::get_this_all($sql);
}

public function get_this_scooter($scooter){
    $sql = "SELECT * FROM scooters WHERE idScooter = $scooter";
    return self::get_this_1($sql);
}

public function get_scooters(){
    $sql = "SELECT * FROM scooters WHERE 1";
    return self::get_this_all($sql);
}

public function get_stats(){
    $sql = "SELECT COUNT(*) as total_users FROM users WHERE 1";
    $udat = self::get_this_1($sql);

    $sql = "SELECT COUNT(*) as total_rides, SUM(distance) as total_distance, SUM(price) as total_earnings FROM rides WHERE 1";
    $rides = self::get_this_1($sql);

    $res = array("user" => $udat,"rides" => $rides);
    return $res;
}


    public function login()
    {
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT idUser, firstname, token FROM users WHERE status_user = 'Admin' AND email = :email AND passwd  = AES_ENCRYPT(:password, '" . PWHASH . "') ";
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

$mkt = new marketModel;

