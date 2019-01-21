<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/init.php';

if (!isset($_SESSION))
    session_start();
$pdo = DB::getConnection();
$stmt = $pdo->prepare("UPDATE users SET `session_end`=NOW() WHERE `username`=:uname");
$user = $_SESSION["login"];
$stmt->bindParam(":uname", $user, PDO::PARAM_STR);
$stmt->execute();
unset($_SESSION);
session_destroy();
session_start();
$_SESSION["login"] = "guest";
header('location: ../index');
exit();
?>