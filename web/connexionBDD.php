<?php
include_once('Conf.php');

define('DSN','pgsql:host='.Conf::$db['host'].';port='.Conf::$db['port'].';dbname='.Conf::$db['database']);
try {
	$connexion=new PDO(DSN,Conf::$db['login'],Conf::$db['mdp']);
}
	catch (PDOException $e){
	echo "erreur de type : " . $e->getMessage() . "<br/>";
	die();
}


?>
