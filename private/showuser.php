<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/init.php';
if (!isset($_SESSION))
    session_start();
if ($_SESSION["login"] != "guest")
{
    if (isset($_POST["user"]))
    {
        $user = htmlspecialchars($_POST["user"]);
        $pdo = DB::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username`=:uname");
        $stmt->bindParam(":uname", $user, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $card = new User($row);
        echo $card->display_CardOnly();
    }
}
?>
