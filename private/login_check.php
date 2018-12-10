<?php

//$generatedKey = sha1(mt_rand(10000,99999).time().$email);
if (!isset($_SESSION))
    session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../config/database.php");
require_once("../classes/User.class.php");
//require_once("../includes/functions.php");

$pdo = DB::getConnection();
if ($pdo == null)
{
	echo json_encode(array("status" => "failure", "message" => "Could not obtain pdo object"));
    //login_error(-1, "Could not obtain a pdo object");
}
if (isset($_POST["submit"])) {
    if ($_POST["submit"] == "Register") {
        $fname = htmlspecialchars($_POST["s_fname"]);
        $lname = htmlspecialchars($_POST["s_lname"]);
        $email = htmlspecialchars($_POST["s_email"]);
        $password = htmlspecialchars($_POST["s_password"]);
        $cpass = htmlspecialchars($_POST["s_cpassword"]);
        $username = htmlspecialchars($_POST["s_username"]);
		$dob = htmlspecialchars($_POST["s_dob"]);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);

        $verification_code;

        if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            //login_error(1, "Password should contain at least one upper case, one lowercase one digit and a special character. Password must be of length 8 and above");
            echo json_encode(array("status" => "failure", "message" => "Password should contain at least one upper case, one lowercase one digit and a special character. Password must be of length 8 and above"));
            exit();
        } else {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username= ?");
            $stmt->execute([$username]);
            $numrows = $stmt->rowCount();
            if ($numrows != 0) {
                //login_error(1, "Username already exists");
                echo json_encode(array(
                    "status" => "failure",
                    "message" => "Username already exists"
                ));
                exit();
            } else {
                if ($cpass != $password) {
                    //login_error(1, "Passwords do not match");
                    echo json_encode(array(
                        "status" => "failure",
                        "message" => "Passwords do not match"
                    ));
                    exit();
                } else {
                    $hashed = password_hash($password, PASSWORD_DEFAULT);
                    $now = new DateTime();
                    $len = 10;
                    $strong = 10;
                    $verification_code = openssl_random_pseudo_bytes($len, $strong);
                    $stmt = $pdo->prepare("INSERT INTO users (`username`, `first_name`, `last_name`, `email`, `hash`, `verification_key`, `birth_date`) VALUES
                        (:uname, :fname, :lname, :email, :hash, :veri, :dob)
                        ");
                    $stmt->bindParam(':uname', $username, PDO::PARAM_STR, 15);
                    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR, 25);
                    $stmt->bindParam(':lname', $lname, PDO::PARAM_STR, 25);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':hash', $hashed, PDO::PARAM_STR);
                    $stmt->bindParam(':veri', $verification_code, PDO::PARAM_STR);
					$stmt->bindParam(":dob",$dob, PDO::PARAM_STR);
                    try {
                        $stmt->execute();
                        //$_SESSION["login"] = $username;
                        $stmt = $pdo->prepare("SELECT id FROM users WHERE username=:uname");
                        $stmt->bindParam(':uname', $username, PDO::PARAM_STR, 15);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        //$_SESSION["user_id"] = (int) $row["id"];
                        $link = "localhost:8080/Matcha/private/activate.php?bar=" . base64_encode($username . "delimiter" . $verification_code);
                        /*
                         * Remember to send out an email here with verification auth details
                         */
                        $to_mail = $email;
                        $header = "FROM: noreply@camagru.com\r\n";
                        $msg = "Welcome to Camagru:" . "<br/>" . "Your username is: " . $username . "<br/>" . "To activate your account please follow the following link:" . "<br/>" . "<a href='" . $link . "'>Activate:" . $link . "</a>" . "<br/>" . "Best\nCamagru Team";
                        $msg = str_replace("\n.", "\n..", $msg);
                        $subject = "Account Activation";
                        $bool = mail($to_mail, $subject, $msg, $header);
                        $header .= "MIME-Version: 1.0\r\n";
                        $header .= "Content-Type: text/html; charset=UTF-8\r\n";
                        if ($bool) {
                            echo json_encode(array(
                                "status" => "succesful",
                                "message" => "Activation Email sent, please check your mail.[Mail may be in spam folder]: "
                            ));
                            exit();
                            //valid_success(1, "Activation Email sent, please check your mail: ", "/index");
                        } else {
                            echo json_encode(array(
                                "status" => "failure",
                                "message" => "Account Created, Could not send activation email."
                            ));
                            exit();
                            //general_error(-1, "Account Created, Could not send activation email.", "/index");
                        }


                        exit();
                    } catch (PDOException $e) {
                        echo json_encode(array(
                            "status" => "failure",
                            "message" => $e->getMessage()
                        ));
                        exit();
                    }
                }
            }
        }
    }
    if ($_POST["submit"] == "Login") {

        $username = htmlspecialchars($_POST["l_username"]);
        $rawpassword = htmlspecialchars($_POST["l_password"]);
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :uname");
        $stmt->bindParam(':uname', $username, PDO::PARAM_STR, 15);
        try {
            $stmt->execute();
            $numRows = $stmt->rowCount();
            if ($numRows == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($rawpassword, $row["hash"])) {
                    //if ($row["verified"] == 0)
                    //   login_error(0, "Please follow the link in your mail to verify your account [Mail might be in spam folder]");
                    $_SESSION["login"] = $username;
                    $_SESSION["user_id"] = (int) $row["id"];
                    $now = new DateTime();
                    $_SESSION["SESSION_KEY"] = password_hash($_SESSION["login"] . $now->format('Y-m-d-H-i-s'), PASSWORD_DEFAULT);
                    //$_SESSION["user_obj"] = new User($row);
                    try
                    {
                        $_SESSION["user_obj"] = new User();
                    }catch(Exception $e)
                    {
                        echo json_encode(array(
                        "status" => "failure",
                        "message" => $e->getMessage()));
                    exit();
                    }
                    //header("location: ../index");'
                    echo json_encode(array(
                        "status" => "success",
                        "message" => "Logged in succesfully"));
                    exit();
                } else {
                    echo json_encode(array(
                        "status" => "failure",
                        "message" => "Username/Password entered does not match any known users"));
                    exit();
                    //login_error(0, "Username/Password entered does not match any known users");
                }
            } else {
                echo json_encode(array(
                    "status" => "failure",
                    "message" => "Username/Password entered does not match any known users"));
                exit();
                //login_error(0, "Username/Password entered does not match any known users");
            }
        } catch (PDOException $e) {
            echo json_encode(array(
                "status" => "failure",
                "message" => $e->getMessage()
            ));
            exit();
            //login_error(0, $e->getMessage());
        }
    }
}
?>