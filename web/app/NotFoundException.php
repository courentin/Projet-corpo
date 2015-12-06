<?php 
/**
* 
*/
class NotFoundException extends \Exception
{
	
	function __construct($msg = "404 - Page not found")
	{
		header("HTTP/1.0 404 Not Found");
		echo $msg;
		exit;
	}
}