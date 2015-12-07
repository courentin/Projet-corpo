<?php 
/**
* 
*/
class Controller
{
	protected function render($filename, $vars = array())
	{
		extract($vars);
		require(ROOT.'view/templateStart.php');
		require(ROOT.'view/'.strtolower(get_class($this)).'/'.$filename.'.php');
		require(ROOT.'view/templateEnd.php');
	}

	protected function redirect($route)
	{
		header("Location: $route");
	}
}