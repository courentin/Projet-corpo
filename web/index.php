<?php 
define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

require(ROOT.'app/Controller.php');
require (ROOT.'app/NotFoundException.php');
require_once (ROOT.'include.php');

$param = explode('/', $_GET['p']);
$controller = (isset($param[0]) && !empty($param[0])) ? $param[0] : 'index';
$action = (isset($param[1]) && !empty($param[1])) ? $param[1] : 'index';

$controller = ucfirst($controller);

$path = "controller/$controller.php";

if(file_exists($path)) {
	require $path;
	$controller = new $controller();
} else {
	throw new NotFoundException();
}

if(method_exists($controller, $action) && is_callable([$controller, $action])) {
	unset($param[0]); unset($param[1]);
	call_user_func_array([$controller, $action], $param);
} else {
	throw new NotFoundException();
}
?>