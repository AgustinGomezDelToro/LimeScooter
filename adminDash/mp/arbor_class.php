<?php

class Arbor {

    public function __construct($data = array()) {

        if (isset($data['email'])) { $this->email = stripslashes(strip_tags($data['email'])); }
        if (isset($data['password'])) { $this->password = stripslashes(strip_tags($data['password'])); }
        if (isset($data['project_name'])) { $this->project_name = stripslashes(strip_tags($data['project_name'])); }
        if (isset($data['project_sdg'])) { $this->project_sdg = stripslashes(strip_tags($data['project_sdg'])); }
        if (isset($data['project_goal'])) { $this->project_goal = stripslashes(strip_tags($data['project_goal'])); }
        if (isset($data['project_description'])) { $this->project_description = stripslashes(strip_tags($data['project_description'])); }
        if (isset($data['project_id'])) { $this->project_id = stripslashes(strip_tags($data['project_id'])); }
        if (isset($data['first_name'])) { $this->first_name = stripslashes(strip_tags($data['first_name'])); }
        if (isset($data['last_name'])) { $this->last_name = stripslashes(strip_tags($data['last_name'])); }
        if (isset($data['email'])) { $this->email = stripslashes(strip_tags($data['email'])); }
        if (isset($data['phone'])) { $this->phone = stripslashes(strip_tags($data['phone'])); }
        if (isset($data['project_doning'])) { $this->project_doning = stripslashes(strip_tags($data['project_doning'])); }
        if (isset($data['amount_doning'])) { $this->amount_doning = stripslashes(strip_tags($data['amount_doning'])); }
        if (isset($data['impact_shares'])) { $this->impact_shares = stripslashes(strip_tags($data['impact_shares'])); }
        if (isset($data['donor_id'])) { $this->donor_id = stripslashes(strip_tags($data['donor_id'])); }
        if (isset($data['user_name'])) { $this->user_name = stripslashes(strip_tags($data['user_name'])); }
        if (isset($data['reset_password'])) { $this->reset_password = stripslashes(strip_tags($data['reset_password'])); }
        if (isset($data['user_status'])) { $this->user_status = stripslashes(strip_tags($data['user_status'])); }
        if (isset($data['user_id'])) { $this->user_id = stripslashes(strip_tags($data['user_id'])); }
        if (isset($data['project_title'])) { $this->project_title = stripslashes(strip_tags($data['project_title'])); }
        if (isset($data['each_donation_means'])) { $this->each_donation_means = stripslashes(strip_tags($data['each_donation_means'])); }
        if (isset($data['each_impact_means'])) { $this->each_impact_means = stripslashes(strip_tags($data['each_impact_means'])); }
        if (isset($data['uid'])) { $this->uid = stripslashes(strip_tags($data['uid'])); }
        if (isset($data['donor_id'])) { $this->donor_id = stripslashes(strip_tags($data['donor_id'])); }
        if (isset($data['project_due_date'])) { $this->project_due_date = stripslashes(strip_tags($data['project_due_date'])); }
        if (isset($data['project_region'])) { $this->project_region = stripslashes(strip_tags($data['project_region'])); }
        if (isset($data['project_impact_goal'])) { $this->project_impact_goal = stripslashes(strip_tags($data['project_impact_goal'])); }
        if (isset($data['project_activity'])) { $this->project_activity = stripslashes(strip_tags($data['project_activity'])); }
        if (isset($data['project_type_of_impact'])) { $this->project_type_of_impact = stripslashes(strip_tags($data['project_type_of_impact'])); }
        if (isset($data['product_name'])) { $this->product_name = stripslashes(strip_tags($data['product_name'])); }
        if (isset($data['product_sdg'])) { $this->product_sdg = stripslashes(strip_tags($data['product_sdg'])); }
        if (isset($data['unlock_shares'])) { $this->unlock_shares = stripslashes(strip_tags($data['unlock_shares'])); }
        if (isset($data['product_description'])) { $this->product_description = stripslashes(strip_tags($data['product_description'])); }
        if (isset($data['qr_text'])) { $this->qr_text = stripslashes(strip_tags($data['qr_text'])); }
        if (isset($data['product_image'])) { $this->product_image = stripslashes(strip_tags($data['product_image'])); }
        if (isset($data['product_id'])) { $this->product_id = stripslashes(strip_tags($data['product_id'])); }
        if (isset($data['product_status'])) { $this->product_status = stripslashes(strip_tags($data['product_status'])); }

    }
/*
Array
(
    [product_name] => testing product
    [product_sdg] => 2
    [unlock_shares] => 125
    [product_description] => sdfsdfsfdsdf
    [qr_text] => some text for the QR code
)
Array
(
    [product_image] => Array
        (
            [name] => Screenshot from 2022-06-14 10-59-42.png
            [type] => image/png
            [tmp_name] => /tmp/phpMsX3OL
            [error] => 0
            [size] => 15174
        )

)*/
public function get_active_products(){
    $sql = "SELECT * FROM products WHERE product_status = 1";
    return self::get_this_all($sql);
}

public function get_products(){
$sql = "SELECT * FROM products WHERE 1";
return self::get_this_all($sql);
}

public function get_this_product($product_id){
    $sql = "SELECT * FROM products WHERE product_id = $product_id";
return self::get_this_1($sql);
}

public function edit_product(){
    try {
        $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE products SET product_name = :product_name,
                                         product_sdg = :product_sdg,
                                         unlock_shares = :unlock_shares,
                                         product_description = :product_description,
                                         product_status = :product_status,
                                         qr_text  = :qr_text
                                WHERE product_id = $this->product_id";

        $stmt = $con->prepare($sql);
        $stmt->bindValue("product_name", $this->product_name, PDO::PARAM_STR);
        $stmt->bindValue("product_sdg", $this->product_sdg, PDO::PARAM_STR);
        $stmt->bindValue("unlock_shares", $this->unlock_shares, PDO::PARAM_STR);
        $stmt->bindValue("product_description", $this->product_description, PDO::PARAM_STR);
        $stmt->bindValue("qr_text", $this->qr_text, PDO::PARAM_STR);
        $stmt->bindValue("product_status", $this->product_status, PDO::PARAM_STR);

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
        $sql = "UPDATE products SET product_image = :product_image
                                WHERE product_id = $this->product_id";

        $stmt = $con->prepare($sql);
        $stmt->bindValue("product_image", $this->product_image, PDO::PARAM_STR);

        $stmt->execute();
    
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "login function error";
    }
}

public function add_product(){
    try {
        $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO products SET product_name = :product_name,
                                         product_sdg = :product_sdg,
                                         unlock_shares = :unlock_shares,
                                         product_description = :product_description,
                                         qr_text  = :qr_text,
                                         product_image = :product_image";
        $stmt = $con->prepare($sql);
        $stmt->bindValue("product_name", $this->product_name, PDO::PARAM_STR);
        $stmt->bindValue("product_sdg", $this->product_sdg, PDO::PARAM_STR);
        $stmt->bindValue("unlock_shares", $this->unlock_shares, PDO::PARAM_STR);
        $stmt->bindValue("product_description", $this->product_description, PDO::PARAM_STR);
        $stmt->bindValue("qr_text", $this->qr_text, PDO::PARAM_STR);
        $stmt->bindValue("product_image", $this->product_image, PDO::PARAM_STR);
        $stmt->execute();
        return $con->lastInsertId();
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "login function error";
    }

}

    public function get_donations(){
        $sql = "SELECT SUM(amount_donor) as money_donated, SUM(shares_impact) as shares FROM donors_projects WHERE date_donor >= DATE(NOW() - INTERVAL 7 DAY)";
        $lw = self::get_this_1($sql);

        $sql = "SELECT SUM(amount_donor) as money_donated, SUM(shares_impact) as shares FROM donors_projects WHERE date_donor >= DATE(NOW() - INTERVAL 30 DAY)";
        $lm = self::get_this_1($sql);

        return array("lw" => $lw, "lm" => $lm);

    }

    public function get_project_funding(){
        $sql = "SELECT SUM(amount_donor) as money_donated, COUNT(DISTINCT(donor_id)) as donors FROM donors_projects WHERE project_id = $this->project_id";
        $lw = self::get_this_1($sql);
        return $lw;
    }

    public function set_refill(){
        $sql = "UPDATE donors SET acount_balance = (acount_balance + 10000), refill_requested = 0 WHERE donor_id = $this->donor_id";
        self::do_this($sql);
        return 1;
    }

    public function check_requests(){
        $sql = "SELECT count(*) as req FROM donors WHERE refill_requested = 1";
        return self::get_this_1($sql);
    }

    public function set_donation(){
        echo 123123123;
    }

    public function get_donor_balance(){
        $sql = "SELECT acount_balance FROM donors WHERE donor_id = $this->uid";
        return self::get_this_1($sql);
    }


    public function edit_user(){
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE admin_users SET first_name = :first_name,
                                             last_name = :last_name,
                                             user_name = :user_name,
                                             email = :email,
                                             user_status = :user_status
                                             WHERE id = $this->user_id
                                             ";
            $stmt = $con->prepare($sql);
            $stmt->bindValue("first_name", $this->first_name, PDO::PARAM_STR);
            $stmt->bindValue("last_name", $this->last_name, PDO::PARAM_STR);
            $stmt->bindValue("email", $this->email, PDO::PARAM_STR);
            $stmt->bindValue("user_name", $this->user_name, PDO::PARAM_STR);
            $stmt->bindValue("user_status", $this->user_status, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "login function error";
        }

        if(isset($this->reset_password) && $this->reset_password === "1"){
            $sql = "UPDATE admin_users SET password = AES_ENCRYPT('$this->email', '" . PWHASH . "'), must_change = 1 WHERE id = $this->user_id";
            self::do_this($sql);
        }

    }
    public function get_this_user($user_id){
        $sql = "SELECT first_name,last_name, user_name, email, user_status FROM admin_users WHERE id= $user_id";
        return self::get_this_1($sql);
    }


    public function create_new_user(){
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO admin_users SET first_name = :first_name,
                                             last_name = :last_name,
                                             user_name = :user_name,
                                             email = :email,
                                             password  = AES_ENCRYPT(:email, '" . PWHASH . "')";
            $stmt = $con->prepare($sql);
            $stmt->bindValue("first_name", $this->first_name, PDO::PARAM_STR);
            $stmt->bindValue("last_name", $this->last_name, PDO::PARAM_STR);
            $stmt->bindValue("email", $this->email, PDO::PARAM_STR);
            $stmt->bindValue("user_name", $this->user_name, PDO::PARAM_STR);
            $stmt->execute();
            return $con->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "login function error";
        }
    }

    public function get_users(){
        $sql = "SELECT id, user_name, email, first_name, last_name FROM admin_users WHERE 1";
        return self::get_this_all($sql);
    }

    public function add_donation($donor_id){
        $amount_doning = str_replace(".","",$this->amount_doning);
        $amount_doning = str_replace(",","",$amount_doning);
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO donors_projects SET donor_id = $donor_id,
                                                    project_id = $this->project_doning,
                                                    date_donor = CURDATE(),
                                                    amount_donor = '$amount_doning',
                                                    shares_impact = '$this->impact_shares'";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            return $con->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "login function error";
        }
    }
    
    public function get_this_donor($donor_id){
        $sql = "SELECT * FROM donors WHERE donor_id = $donor_id";
        return self::get_this_1($sql);
    }

    public function edit_donor(){
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE donors SET first_name = :first_name,
                                             last_name = :last_name,
                                             email = :email,
                                             phone = :phone
                                    WHERE donor_id = $this->donor_id";
            $stmt = $con->prepare($sql);
            $stmt->bindValue("first_name", $this->first_name, PDO::PARAM_STR);
            $stmt->bindValue("last_name", $this->last_name, PDO::PARAM_STR);
            $stmt->bindValue("email", $this->email, PDO::PARAM_STR);
            $stmt->bindValue("phone", $this->phone, PDO::PARAM_STR);
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "login function error";
        }
    }

    public function create_new_donor(){
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO donors SET first_name = :first_name,
                                             last_name = :last_name,
                                             email = :email,
                                             password  = AES_ENCRYPT(:email, '" . PWHASH . "'),
                                             must_change = 1,
                                             phone = :phone";
            $stmt = $con->prepare($sql);
            $stmt->bindValue("first_name", $this->first_name, PDO::PARAM_STR);
            $stmt->bindValue("last_name", $this->last_name, PDO::PARAM_STR);
            $stmt->bindValue("email", $this->email, PDO::PARAM_STR);
            $stmt->bindValue("phone", $this->phone, PDO::PARAM_STR);
            $stmt->execute();
            return $con->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "login function error";
        }
    }


    public function storeFormValues($params) {
        $this->__construct($params);
    }
    
    public function get_donors(){
        $sql = "SELECT * FROM donors WHERE 1";
        return self::get_this_all($sql);
    }
   
    public function edit_project(){
        $due_date = date('Y-m-d', strtotime($this->project_due_date));

        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE projects SET project_name = :project_name,
            project_sdg = :project_sdg,
            project_goal = :project_goal,
            project_description = :project_description,
            each_impact_means = :each_impact_means,
            each_donation_means = :each_donation_means,
            project_title = :project_title,
            project_region = :project_region,
            project_impact_goal = :project_impact_goal,
            project_activity = :project_activity,
            project_type_of_impact = :project_type_of_impact                                             
                                    WHERE project_id = :project_id";

            $stmt = $con->prepare($sql);
            $stmt->bindValue("project_name", $this->project_name, PDO::PARAM_STR);
            $stmt->bindValue("project_sdg", $this->project_sdg, PDO::PARAM_STR);
            $stmt->bindValue("project_goal", str_replace(",","",$this->project_goal), PDO::PARAM_INT);
            $stmt->bindValue("project_description", $this->project_description, PDO::PARAM_STR);
            $stmt->bindValue("each_impact_means", str_replace(",","",$this->each_impact_means), PDO::PARAM_STR);
            $stmt->bindValue("each_donation_means", str_replace(",","",$this->each_donation_means), PDO::PARAM_STR);
            $stmt->bindValue("project_title", $this->project_title, PDO::PARAM_STR);
            $stmt->bindValue("project_region", $this->project_region, PDO::PARAM_STR);
            $stmt->bindValue("project_impact_goal", $this->project_impact_goal, PDO::PARAM_STR);
            $stmt->bindValue("project_activity", $this->project_activity, PDO::PARAM_STR);
            $stmt->bindValue("project_type_of_impact", $this->project_type_of_impact, PDO::PARAM_STR);
            $stmt->bindValue("project_id", $this->project_id, PDO::PARAM_STR);


            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "edit_project function error";
        }
    }

/*
    [project_region] => sdsdfdsffsd
    [project_impact_goal] => dfsfs
    [project_activity] => sdfsfd
    [project_type_of_impact] => dsfsdf
    [project_description] => sdfsdfsfsdffd
)

*/
    public function create_project(){
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO projects SET project_name = :project_name,
                                             project_sdg = :project_sdg,
                                             project_goal = :project_goal,
                                             project_description = :project_description,
                                             each_impact_means = :each_impact_means,
                                             each_donation_means = :each_donation_means,
                                             project_title = :project_title,
                                             project_region = :project_region,
                                             project_impact_goal = :project_impact_goal,
                                             project_activity = :project_activity,
                                             project_type_of_impact = :project_type_of_impact";

            $stmt = $con->prepare($sql);
            $stmt->bindValue("project_name", $this->project_name, PDO::PARAM_STR);
            $stmt->bindValue("project_sdg", $this->project_sdg, PDO::PARAM_STR);
            $stmt->bindValue("project_goal", str_replace(",","",$this->project_goal), PDO::PARAM_INT);
            $stmt->bindValue("project_description", $this->project_description, PDO::PARAM_STR);
            $stmt->bindValue("each_impact_means", str_replace(",","",$this->each_impact_means), PDO::PARAM_STR);
            $stmt->bindValue("each_donation_means", str_replace(",","",$this->each_donation_means), PDO::PARAM_STR);
            $stmt->bindValue("project_title", $this->project_title, PDO::PARAM_STR);
            $stmt->bindValue("project_region", $this->project_region, PDO::PARAM_STR);
            $stmt->bindValue("project_impact_goal", $this->project_impact_goal, PDO::PARAM_STR);
            $stmt->bindValue("project_activity", $this->project_activity, PDO::PARAM_STR);
            $stmt->bindValue("project_type_of_impact", $this->project_type_of_impact, PDO::PARAM_STR);
            $stmt->execute();
            return $con->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "login function error";
        }
    }

    public function get_donor_history($donor_id){
        $sql = "SELECT a.*, b.project_name FROM donors_projects a JOIN projects b ON a.project_id = b.project_id WHERE a.donor_id = $donor_id";
        return self::get_this_all($sql);
    }
    public function get_active_projects(){
        $sql = "SELECT * FROM projects WHERE project_active = 1";
        return self::get_this_all($sql);
    }

    public function get_this_project(){
        $sql = "SELECT *, datediff(project_due_date, now()) as days_remaining FROM projects WHERE project_id = $this->project_id";
        return self::get_this_1($sql);
    }

    public function get_this_sdg($sdg_id){
        $sql = "SELECT * FROM sdgs WHERE sdg_id = $sdg_id";
        return self::get_this_1($sql);
    }

    public function get_project_titles(){
        $sql = "SELECT project_name, project_id, project_goal, project_active FROM projects WHERE 1";
        return self::get_this_all($sql);
    }

    public function get_sdgs(){
        $sql = "SELECT * FROM sdgs WHERE 1";
        return self::get_this_all($sql);
    }

    public function get_projects_by_donor($user_id){
        $sql = "SELECT GROUP_CONCAT(DISTINCT(project_id) SEPARATOR ', ')as project_id FROM donors_projects WHERE donor_id = $user_id";
        return self::get_this_1($sql);
    }

    public function show_me() {
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT *, AES_DECRYPT(password, '" . PWHASH . "') as password FROM admin_users WHERE 1";
            $stmt = $con->prepare($sql);
            $stmt->bindValue("user_name", $this->user_name, PDO::PARAM_STR);
            $stmt->bindValue("password", $this->password, PDO::PARAM_STR);
            $stmt->execute();
            $valid = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $valid;
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "login function error";
        }
    }


    public function login_admin() {
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT id, first_name, last_name, user_name FROM admin_users WHERE email = :email AND password  = AES_ENCRYPT(:password, '" . PWHASH . "') ";
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

    public function login() {
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT user_name FROM users WHERE user_name = :user_name AND password  = AES_ENCRYPT(:password, '" . PWHASH . "') ";
            $stmt = $con->prepare($sql);
            $stmt->bindValue("user_name", $this->user_name, PDO::PARAM_STR);
            $stmt->bindValue("password", $this->password, PDO::PARAM_STR);
            $stmt->execute();
            $valid = $stmt->fetch(PDO::FETCH_OBJ);
            return $valid;
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "login function error";
        }
    }


    public function get_countries(){
        $sql = "SELECT * FROM countries ORDER BY country_name";
        return self::get_this_All($sql);
    }

    public function do_this($sql) {
        try {
            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $con->prepare($sql);
            $stmt->execute();
            return 1;
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo "doThis error";
            echo $sql."<br>";
        }
    }

    public function get_this_1($sql) {
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

    public function get_this_all($sql) {
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

    public function insert_return_last_id($sql) {
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


$arbor = new Arbor;
