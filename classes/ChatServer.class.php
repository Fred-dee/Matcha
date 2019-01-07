<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/init.php';
if (!isset($_SESSION))
    session_start();
class ChatServer
{
	public static $_source = null;
	
	private static function isMatch($value1, $value2, $string)
	{
		//$pattern= "/".$value1.":".$value2."/"
		if (preg_match("/".$value1.":".$value2."/", $string) || preg_match("/".$value2.":".$value1."/", $string) )
			return true;
		return false;
	}
	
	public static function getConversation($username)
	{
		if (self::$_source == null)
			self::init();
		
		$keys = array_keys(self::$_source);
		$myconvos = array();
		foreach ($keys as $value)
		{
			if (self::isMatch($_SESSION["login"], $username, $value))
				array_push($myconvos, $username);
		}
		//$myconvos = array_search($_SESSION["login"], $keys);
		return $myconvos;
		
	}
	
	public static function init()
	{
		self::$_source = json_decode(file_get_contents("./private/chats.txt"), true);
	}
	
}

?>