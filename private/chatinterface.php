<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/init.php';

if (!isset($_SESSION))
    session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["login"] != "guest")
{

	if (isset($_POST["get_chat"]) && $_POST["get_chat"] == true)
	{

		$user = htmlspecialchars($_POST["username"]);
		$chat_items = array();
		$source = ChatServer::getConversation($user);
		$sender = "";
		for ($i = 0; $i < count($source); $i = $i + 2)
		{
			if ($source[$i] == $_SESSION["login"])
				$sender = "You";
			else
				$sender = $source[$i];
			$tmp = new Message($sender, $source[i+1]);
			array_push($chat_items, $tmp->__toString());
		}
		echo json_encode($chat_items);
		
		//echo count($source);
		
	}

} 
//echo "done";

?>