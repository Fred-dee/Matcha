<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/init.php';
if (!isset($_SESSION))
{
    session_start();
}
if ($_SESSION["login"] != "guest") {
    //if (isset($_POST["data"]) && $_POST["data"] == true) {
        if (!isset($_SESSION["data_start"]) || (isset($_POST["reset"]) && $_POST["reset"] == true)) {
            $_SESSION["data_start"] = true;
            $_SESSION["data_offset"] = 0;
        }
        if ($_SESSION["data_start"] == true) {
            $pdo = DB::getConnection();
            $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username` != :uname LIMIT 1 OFFSET :off");
            $stmt->bindParam(":uname", $_SESSION["login"], PDO::PARAM_STR);
            $stmt->bindParam(":off", $_SESSION["data_offset"], PDO::PARAM_INT);
            $stmt->execute();
            if (($row = $stmt->fetch(PDO::FETCH_ASSOC))) {
                $user = new User($row);
                $user->display_publicCard(true);
                if ((isset($_POST["data"]) && $_POST["data"] == true))
                    $_SESSION["data_offset"]++;
            } else {
                unset($_SESSION["data_start"]);
                $_SESSION["data_start"] = false;
                $_SESSION["data_offset"] = 0;
            }
        }
    //}
    if (isset($_POST["action"])) {
        $action_to = htmlspecialchars(base64_decode($_POST["user"]));
        $action = htmlspecialchars($_POST["action"]);
        $action_by = $_SESSION["user_obj"]->get_username();
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare("INSERT INTO `events` (`actioned_by`, `action`, `actioned_towards`) VALUES (:aby, :act, :ato)");
        $stmt->bindParam(":aby", $action_by , PDO::PARAM_STR, 20);
        $stmt->bindParam(":act", $action, PDO::PARAM_STR);
        $stmt->bindParam(":ato", $action_to, PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>
