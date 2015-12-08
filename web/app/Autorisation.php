<?php
	/**
	* Verifie l'autorisation d'un utilisateur à accéder à cette page
	*/
	class Autorisation
	{
		public static function autoriser($rangAutorise, $redirect = null)
		{
			$auth = true;
			if(isset($_SESSION['utilisateur']) && $rangAutorise !== 'connect') {

				$db = App::getDatabase();
				$utilisateur = new Utilisateur($_SESSION['utilisateur']['idUtilisateur']);

				if($utilisateur->getRang()->getId() >= $rangAutorise)
					$auth = false;

			} else $auth = false;

			if(!$auth) {
				header("HTTP/1.1 401 Unauthorized");
				if($redirect != null) header("Location: ".WEBROOT."$redirect");
				exit();
			}
		}

		public static function nePasAutoriser($rangAutorise, $redirect = null)
		{
			if(isset($_SESSION['utilisateur'])) {
				$db = App::getDatabase();
				$utilisateur = new Utilisateur($_SESSION['utilisateur']['idUtilisateur']);

				if($utilisateur->getRang()->getId() < $rangAutorise) {
					header("HTTP/1.1 401 Unauthorized");
					if($redirect != null) header("Location: $redirect");
					exit();
				}
			} else $auth = false;


		}
	}

?>
