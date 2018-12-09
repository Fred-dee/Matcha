<?php

if (!isset($_SESSION))
    session_start();
require_once("../config/database.php");
require_once("../includes/functions.php");
if (isset($_POST)) {
    $pdo = DB::getConnection();
    if (isset($_POST["reset"]) == null) {
        $bool = intval($_POST["em_subs"]);
        if ($bool != 1)
            $bool = 0;
        $stmt = $pdo->prepare("UPDATE users SET first_name = :fname, last_name = :lname, email = :email, em_subs = :sub WHERE user_name = :uname");
        $stmt->bindParam(':fname', $_POST["First_Name"], PDO::PARAM_STR, 25);
        $stmt->bindParam(':lname', $_POST["Last_Name"], PDO::PARAM_STR, 25);
        $stmt->bindParam(':email', $_POST["Email_Address"], PDO::PARAM_STR);
        $stmt->bindParam(':uname', $_SESSION["login"], PDO::PARAM_STR, 25);
        $stmt->bindParam(':sub', $bool, PDO::PARAM_INT);
        if ($stmt->execute()) {
			$append = "";
			if($_POST["Username"] != $_SESSION["login"])
			{
				$stmt = $pdo->prepare("SELECT * FROM `users` WHERE user_name= :uname");
				$stmt->bindParam(":uname", $_POST["Username"], PDO::PARAM_STR);
				$stmt->execute();
				if($stmt->rowCount() == 0)
				{
					$stmt = $pdo->prepare("UPDATE `users` SET user_name=:uname WHERE user_name=:old_name");
					$stmt->bindParam(":uname", $_POST["Username"], PDO::PARAM_STR, 15);
					$stmt->bindParam(":old_name", $_SESSION["login"], PDO::PARAM_STR, 15);
					$stmt->execute();
					$_SESSION["login"] = htmlspecialchars($_POST["Username"]);
				}
				else
					$append = ". However we were unable to change your username as a user by that name already exists.";
			}
            valid_success(-1, "Your information has been updated succesfully".$append, "/profile");
        } else
            profile_error(-1, "Could not update your profile");
    }
    else {
        $pass = htmlspecialchars($_POST["npsswd"]);
        $uppercase = preg_match('@[A-Z]@', $pass);
        $lowercase = preg_match('@[a-z]@', $pass);
        $number = preg_match('@[0-9]@', $pass);
        if (!$uppercase || !$lowercase || !$number || strlen($pass) < 8) {
            general_error(1, "Password should contain at least one upper case, one lowercase one digit and a special character. Password must be of length 8 and above", "/forgot?reset=" . $_POST["reset"]);
        }
        if ($_POST["reset"] == "update") {
            $stmt = $pdo->prepare("SELECT hash FROM users WHERE user_name=:uname");
            $stmt->bindParam(':uname', $_SESSION["login"], PDO::PARAM_STR);
            try {
                $stmt->execute();

                $hash = $stmt->fetch(PDO::FETCH_ASSOC);
                if (($hash != null) && (password_verify($_POST["psswd"], $hash["hash"]) == true)) {
                    if ($_POST["npsswd"] == $_POST["npsswdc"]) {
                        $nhash = password_hash($pass, PASSWORD_DEFAULT);
                        $stmt = $pdo->prepare("UPDATE users SET hash=:nhash WHERE user_name = :uname");
                        $stmt->bindParam(":nhash", $nhash, PDO::PARAM_STR);
                        $stmt->bindParam(":uname", $_SESSION["login"]);
                        $stmt->execute();
                        valid_success(-1, "You've succesfully updated your password", "/profile");
                    } else
                        general_error(-1, "The new passwords you have entered do not match.", "/forgot?reset=update");
                } else
                    general_error(-1, "Incorrect Password", "/forgot?reset=update");
            } catch (\PDOException $e) {
                general_error((int) $e->getCode(), $e->getMessage(), "/forgot?reset=update");
            }
        } elseif ($_POST["reset"] == "reset") {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE user_name=:uname");
            $stmt->bindParam(':uname', $_POST["username"], PDO::PARAM_STR);
            try {
                $stmt->execute();
                if ($stmt->rowCount() == 1) {
                    if ($_POST["npsswd"] == $_POST["npsswdc"]) {
                        $stmt = $pdo->prepare("UPDATE users SET hash=:nhash WHERE user_name = :uname");
                        $stmt->bindParam(":nhash", password_hash($pass, PASSWORD_DEFAULT), PDO::PARAM_STR);
                        $stmt->bindParam(":uname", $_POST["username"]);
                        $stmt->execute();
                        valid_success(-1, "You've succesfully updated your password", "/index");
                    } else
                        general_error(-1, "The new passwords you have entered do not match.", "/forgot?reset=reset");
                } else
                    general_error(-1, "Invalid Username:".$stmt->rowCount()." ".$_POST["username"], "/forgot?reset=reset");
            } catch (\PDOexception $e) {
                general_error((int) $e->getCode(), $e->getMessage(), "/forgot?reset=reset");
            }
        }
    }
}
?>