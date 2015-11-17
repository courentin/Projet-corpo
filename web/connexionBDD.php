<?php

$login='jannou';
define('MDP','mdp');
$bd='siteCorpo';

define('DSN','pgsql:host=localhost;port=5432;dbname='.$bd);
try {
	$connexion=new PDO(DSN,$login,MDP); 
	print_r($connexion);
}
	catch (PDOException $e){
	echo "erreur de type : " . $e->getMessage() . "<br/>";
	die();
}


?>
