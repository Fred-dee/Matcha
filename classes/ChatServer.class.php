<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/init.php';
if (!isset($_SESSION))
    session_start();
class ChatServer
{
	public static $_source = null;
	
	public static function getConversation()
	{
		if (self::$_source == null)
			self::init();
	
	}
	
	public static function init()
	{
		slef::$_source = file_get_contents("./private/chats.txt");
	}
	
}

?>