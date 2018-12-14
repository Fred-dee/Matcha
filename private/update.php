<?php
	require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/init.php';
	if (!isset($_SESSION))
    	session_start();
	echo json_encode(array("status" => "success", "message" => "It was able to send the information"));
	exit();
?>