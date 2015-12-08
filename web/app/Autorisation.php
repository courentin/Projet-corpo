<?php
	/**
	* Verifie l'autorisation d'un utilisateur à accéder à cette page
	*/
	class Autorisation
	{
		public static function autoriser($rangAutorise, $redirect = null)
		{
			$db = App::getDatabase();
			$utilisateur = new Utilisateur($_SESSION['utilisateur']['idUtilisateur']);

			if(!isset($_SESSION['ut7']) || $utilisateur->getRang()->getId() > $rangAutorise) {
				header("HTTP/1.1 401 Unauthorized");
				if($redirect != null) header("Location: $redirect");
				exit();
			}
		}

		public static function nePasAutoriser($rangAutorise, $redirect = null) {
			$db = App::getDatabase();
			$utilisateur = new Utilisateur($_SESSION['utilisateur']['idUtilisateur']);

			if($utilisateur->getRang()->getId() < $rangAutorise) {
				header("HTTP/1.1 401 Unauthorized");
				if($redirect != null) header("Location: $redirect");
				exit();
			}
		}
	}

?>
