<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/init.php';
if (!isset($_SESSION))
    session_start();
class ChatServer
{
	public static $_source = null;
	
	private static function isPair($value1, $value2, $string)
	{
		//$pattern= "/".$value1.":".$value2."/"
		if (preg_match("/".$value1.":".$value2."/", $string) || preg_match("/".$value2.":".$value1."/", $string) )
			return true;
		return false;
	}
	
	private static function isMatch($value1, $string)
	{
		if (preg_match("/".$value1."/", $string))
			return true;
		return false;
	}
	
	public static function getConversation($username)
	{
		if (self::$_source == null)
			self::init();
		$keys = array_keys(self::$_source);
		$convo;
		foreach ($keys as $value)
		{
			if (self::isPair($_SESSION["login"], $username, $value))
			{
				return self::$_source[$value];
			}
		}
	}
	
	public static function getConversations()
	{
		if (self::$_source == null)
			self::init();
		
		$keys = array_keys(self::$_source);
		$myconvos = array();
		foreach ($keys as $value)
		{
			if (self::isMatch($_SESSION["login"], $value))
			{
				
				$other_user;
				$split = preg_split("/:/", $value);
				if ($split[0] == $_SESSION["login"])
					$other_user = $split[1];
				else
					$other_user = $split[0];
				array_push($myconvos, $other_user);
			}
		}
		return $myconvos;
	}
	
	public static function init()
	{
		self::$_source = json_decode(file_get_contents("./private/chats.txt"), true);
	}
	
}

?>