<?php
	/**
	* Verifie l'autorisation d'un utilisateur à accéder à cette page
	*/
	class Autorisation
	{
		public static function autoriser($rangAutorise)
		{
			include("connexionBDD.php");
			//recupere l'id du rang autorise sur la page
			$rangPageSql = "SELECT idRang FROM Rang WHERE nomRang='".$rangAutorise."'";
			$rangPageExec = $connexion->query($rangPageSql);
			$rangPage = $rangPageExec->fetch(PDO::FETCH_ASSOC);

			//recupere l'id du rang de l'utilisateur
			$rangUtilisateurSql = "SELECT rang FROM Utilisateur WHERE idUtilisateur =".$_SESSION['idUtilisateur'];
			$rangUtilisateurExec = $connexion->query($rangUtilisateurSql);
			$rangUtilisateur = $rangUtilisateurExec->fetch(PDO::FETCH_ASSOC);

			include("deconnexionBDD.php");

			if($rangUtilisateur['rang'] <= $rangPage['idrang'])
			{
			}
			else
			{
				header("Location:index.php");
				exit();
			}  
		}
	}

	
?>