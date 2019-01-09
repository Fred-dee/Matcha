<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/init.php';
if (!isset($_SESSION))
    session_start();

class Message extends Element
{
	private $_sender,
			$_content,
			$_time,
			$_status;
	
	/*
		TODO:
		get the time to convert get the status to show different icons depending on if it was read or not!
	*/
	public function __construct($sender = "You", $particulars = array())
	{
		parent::__construct("div", false, array("class" => "message alert-success"));
		$this->_sender = new Element("span", false, array("class" => "message-sender"));
		$this->_sender->add_text($sender);
		$this->_content = new Element("span", false, array("class" => "message-content"));
		$this->_content->add_text($particulars[0]);
		$this->_time = new Element("span", false, array("class" => "message-time"));
		$this->_time->add_text($particulars[1]);
		$this->_status = new Element("span", false, array("class" => "message-status"));
		$this->_status->add_text($particulars[2]);
		$this->add_child($this->_sender);
		$this->add_child($this->_content);
		$this->add_child($this->_time);
		$this->add_child($this->_status);
	}
}


?>