<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/classes/UserCard.class.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/config/database.php';

class User {

    private $_pdo,
            $_id,
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
        //$this->_pdo = DB::getConnection();
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
        $stmt = $this->_pdo->prepare("Select `src`, `type` FROM `images` WHERE user_id=:id");
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

    public function set_bio($text)
    {
       $this->_pdo = DB::getConnection(); 
        $this->_bio = htmlspecialchars($text);
        $stmt = $this->_pdo->prepare("UPDATE `users` SET bio=:b WHERE id=:uid");
        $stmt->bindParam(":b", $this->_bio, PDO::PARAM_STR);
        $stmt->bindParam(":uid", $this->_id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }
    
    public function display_publicCard($reset = false)
    {
        if ($reset == false)
            echo $this->__toString();
        else
        {
            $this->_card = new UserCard();
            echo $this->__toString();
        }
    }
    
    public function get_firstName()
    {
        return $this->_fname;
    }
    public function update($fields = array()) {
        
    }

}

;
?>