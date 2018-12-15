<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/init.php';
if (!isset($_SESSION))
    session_start();

class User {

    private static $_pdo;
    private $_id,
            $_username,
            $_bio,
            $_age,
            $_fname,
            $_lname,
            $_email,
            $_card,
            $_job,
            $_gender;

    public function __construct($fields = array()) {
        //var_dump($fields);
        foreach ($fields as $key => $value) {
            switch ($key) {
                case "username":
                    $this->_username = $value;
                    break;
                case "id":
                    $this->_id = $value;
                    break;
                case "bio":
                    $this->_bio = $value;
                    break;
                case "birth_date":
                    $this->_age = $this->calculate_age($value);
                    break;
                case "email":
                    $this->_email = $value;
                    break;
                case "first_name":
                    $this->_fname = $value;
                    break;
                case "last_name":
                    $this->_lname = $value;
                    break;
                case "ocupation":
                    $this->_job = $value;
                    break;
                case "gender":
                    $this->_gender = $value;
                    break;
            }
        }
        $this->_card = new UserCard();
        self::$_pdo = DB::getConnection();
    }

    private function convertString($date) {
        // convert date and time to seconds 
        $sec = strtotime($date);


        $date_new = date("m/d/Y", $sec);
        return $date_new;
    }

    private function calculate_age($birthDate) {
        $birthDate = $this->convertString($birthDate);
        $birthDate = explode("/", $birthDate);
        //get age from date or birthdate
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
        return ($age);
    }

    public function __destruct() {
        
    }

    private function populateCard() {
        $imgattrs = array(
            "class" => "d-block w-100 card-picture",
            "alt" => "./imgs/avatar.png",
            "type" => "jpg"
        );
        self::$_pdo = DB::getConnection();
        $stmt = self::$_pdo->prepare("Select `src`, `type` FROM `images` WHERE user_id=:id ORDER BY `position` ASC");
        $stmt->bindParam(":id", $this->_id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            $this->_card->add_images("./imgs/avatar.png", true, $imgattrs);
        } else {
            while (($res = $stmt->fetch(PDO::FETCH_ASSOC))) {
                $imgattrs["type"] = $res["type"];
                $this->_card->add_images($res["src"], false, $imgattrs);
            }
        }
        $this->_card->set_cardText($this->_job);
        $this->_card->set_Title($this->_fname . " " . $this->_lname . ", " . $this->_age);
        $this->_card->set_bioText($this->_bio);
        $this->_card->assemble();
    }

    public function __toString() {

        $this->populateCard();
        $ret_string = "";
        $ret_string .= $this->_card;
        return $ret_string;
    }

    public function set_bio($text) {
        $text = trim(htmlspecialchars($text));
        if ($text != $this->_bio) {
            try {
                self::$_pdo = DB::getConnection();
                $this->_bio = htmlspecialchars($text);
                $stmt = self::$_pdo->prepare("UPDATE `users` SET bio=:b WHERE id=:uid");
                $stmt->bindParam(":b", $text, PDO::PARAM_STR);
                $stmt->bindParam(":uid", $this->_id, PDO::PARAM_INT);
                $stmt->execute();
                $this->_bio = $text;
            } catch (\PDOException $e) {
                die($e->getMessage());
            }
            return true;
        }
        return false;
    }

    public function set_firstName($text) {
        $text = trim(htmlspecialchars($text));
        if ($text != $this->_fname) {
            try {
                self::$_pdo = DB::getConnection();

                $stmt = self::$_pdo->prepare("UPDATE `users` SET first_name=:fname WHERE id=:uid");
                $stmt->bindParam(":fname", $text, PDO::PARAM_STR);
                $stmt->bindParam(":uid", $this->_id, PDO::PARAM_INT);
                $stmt->execute();
                $this->_fname = $text;
            } catch (\PDOException $e) {
                die($e->getMessage());
            }
            return true;
        }
        return false;
    }

    public function set_lastName($text) {
        $text = trim(htmlspecialchars($text));
        if ($text != $this->_lname) {
            try {
                self::$_pdo = DB::getConnection();

                $stmt = self::$_pdo->prepare("UPDATE `users` SET last_name=:lname WHERE id=:uid");
                $stmt->bindParam(":lname", $text, PDO::PARAM_STR);
                $stmt->bindParam(":uid", $this->_id, PDO::PARAM_INT);
                $stmt->execute();
                $this->_lname = $text;
            } catch (\PDOException $e) {
                die($e->getMessage());
            }
            return true;
        }
        return false;
    }

    public function set_email($text) {
        $text = trim(htmlspecialchars($text));
        if ($text != $this->_email) {
            try {
                self::$_pdo = DB::getConnection();

                $stmt = self::$_pdo->prepare("UPDATE `users` SET email=:email WHERE id=:uid");
                $stmt->bindParam(":email", $text, PDO::PARAM_STR);
                $stmt->bindParam(":uid", $this->_id, PDO::PARAM_INT);
                $stmt->execute();
                $this->_email = $text;
            } catch (\PDOException $e) {
                die($e->getMessage());
            }
            return true;
        }
        return false;
    }

    public function set_username($text) {
        $text = trim(htmlspecialchars($text));
        if ($text != $this->_username) {
            try {
                self::$_pdo = DB::getConnection();
                $stmt = self::$_pdo->prepare("SELECT * FROM `users` WHERE `username`=:nuname");
                $stmt->bindParam(":nuname", $text, PDO::PARAM_STR);
                $stmt->execute();
                if ($stmt->rowCount() != 0)
                    return false;
                $stmt = self::$_pdo->prepare("UPDATE `users` SET username=:nuname WHERE id=:uid");
                $stmt->bindParam(":nuname", $text, PDO::PARAM_STR);
                $stmt->bindParam(":uid", $this->_id, PDO::PARAM_INT);
                $stmt->execute();
                $this->_username = $text;
            } catch (\PDOException $e) {
                die($e->getMessage());
            }
        }
    }

    public function display_publicCard($reset = false) {
        if ($reset == false)
            echo $this->__toString();
        else {
            $this->_card = new UserCard();
            echo $this->__toString();
        }
    }

    public function get_firstName() {
        return $this->_fname;
    }

    public function get_lastName() {
        return $this->_lname;
    }

    public function get_email() {
        return $this->_email;
    }

    public function get_bio() {
        return $this->_bio;
    }

    public function get_userName() {
        return $this->_username;
    }

    public function update_individual($fields = array()) {
        if (!empty($fields)) {
            try {

                foreach ($fields as $key => $value) {
                    if ($key === "fname" || $key === "first_name") {
                        $this->set_firstName($value);
                    }
                    if ($key === "lname" || $key === "last_name") {
                        $this->set_lastName($value);
                    }
                    if ($key === "bio" || $key === "biography") {
                        $this->set_bio($value);
                    }
                    if ($key == "email")
                        $this->set_email($value);
                    if ($key == "username")
                        $this->set_username($value);
                }
                return true;
            } catch (\PDOException $e) {
                die($e->getMessage());
            }
        }
        return false;
    }

    public function insert_image($img_type, $base64_src, $position) {
        try {
            self::$_pdo = DB::getConnection();
            $stmt = self::$_pdo->prepare("SELECT * FROM `images` WHERE `user_id`=:uid AND `position`=:pos");
            $stmt->bindParam(":uid", $this->_id, PDO::PARAM_INT);
            $stmt->bindParam(":pos", $position, PDO::PARAM_INT);
            $stmt->execute();
            $sql;
            if ($stmt->rowCount() == 0)
            {
                $sql = "INSERT INTO `images` (`src`, `type`, `user_id`, `position`) VALUES (:src, :type, :uid, :pos)";
            }
            else
            {
                $sql = "UPDATE `images` SET `type`=:type, `src`=:src WHERE `user_id`=:uid AND `position`=:pos";
            }
            $stmt = self::$_pdo->prepare($sql);
            $stmt->bindParam(":uid", $this->_id, PDO::PARAM_INT);
            $stmt->bindParam(":pos", $position, PDO::PARAM_INT);
            $stmt->bindParam(":type", $img_type, PDO::PARAM_STR);
            $stmt->bindParam(":src", $base64_src, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
    }

}

;
?>