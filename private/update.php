<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/init.php';
if (!isset($_SESSION))
    session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curr_user = $_SESSION["user_obj"];
    if ($_SESSION["user_obj"]) {
        $fields = array(
            "first_name" => $_POST["p_fname"],
            "last_name" => $_POST["p_lname"],
            "username" => $_POST["p_username"],
            "email" => $_POST["p_email"],
            "bio" => $_POST["p_bio"]
        );
        if ($_SESSION["user_obj"]->update_individual($fields)) {
            echo json_encode(array("status" => "success", "message" => "User info succesfully updated"));
            exit();
        } else {
            echo json_encode(array("status" => "failure", "message" => "Unknown Error"));
        }
    }
}
echo json_encode(array("status" => "success", "message" => "It was able to send the information"));
exit();
?>