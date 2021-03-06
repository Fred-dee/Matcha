<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/init.php';
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
if (!isset($_SESSION))
    session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["login"] != "guest") {

    if (isset($_POST["get_chat"]) && $_POST["get_chat"] == true) {

        $user = htmlspecialchars($_POST["username"]);
        $chat_items = array();
        $source = ChatServer::getConversation($user);
        /*$sender = "";
        if (!empty($source)) {
            for ($i = 0; $i < count($source); $i = $i + 2) {
                if ($source[$i] == $_SESSION["login"])
                    $sender = "You";
                else
                    $sender = $source[$i];
                $tmp = new Message($sender, $source[$i + 1]);
                array_push($chat_items, $tmp->__toString());
            }
            echo json_encode($chat_items);
            exit();
        }*/
        //exit();
        //echo count($source);
    }
    if (isset($_POST["send_message"]) && $_POST["send_message"] == true) {

        $arr_response = array(
            "status" => "",
            "message" => ""
        );
        $user = htmlspecialchars($_POST["username"]);
        $message = htmlspecialchars($_POST["message_tosend"]);
        if (ChatServer::sendMessage($user, $message)) {
            $arr_response["status"] = "success";
            $arr_response["message"] = "Succesfully sent message";
            $msg = new Message("You", time(), "unread");
            $arr_response["object"] = $msg->__toString();
        } else {
            $arr_response["status"] = "failure";
            $arr_response["message"] = "Was unable to send the message";
        }
        echo json_encode($arr_response);
        exit();
        //echo "I entered";
    }

    // echo $_POST["send_message"];
}
?>