<?php
class asynctologmessage{
	const DEBUG 		= 1;
	const NOTICE 		= 2;
	const WARNING 	= 3;
	const ERROR 		= 4;
	const CRITICAL	= 5;

	private $level;
	private $message;
	private $code;
	private $method;
	private $time;

	public function __construct($level, $message, $code = 0, $method = null)
	{
		$this->level 		= $level;
		$this->message 	= $message;
		$this->code 		= $code;
		$this->method 	= $method;
		$this->time			= microtime();
	}

	public function __toString()
	{
		$s = "";
		switch($this->level)
		{
			case self::DEBUG: 		$s = "[debug]"; 		break;
			case self::NOTICE: 		$s = "[notice]"; 		break;
			case self::WARNING: 	$s = "[warning]"; 	break;
			case self::ERROR: 		$s = "[error]"; 		break;
			case self::CRITICAL:	$s = "[critical]";	break;
			default: 							$s = "[unknown]";		break;
		}
		$s .= " ".$this->time." ".$this->method." (".$this->code.") ".$this->message;

		return $s;
	}

	public function getLevel()
	{
		return $this->level;
	}
}
?>