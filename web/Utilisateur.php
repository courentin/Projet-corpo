<?php 

class Utilisateur {
	private $nom;
	private $prenom;
	private $mdp;
	private $email;
	
	public function __construct($nom,$prenom,$email,$mdp)
	{
		$this->nom=$nom;
		$this->prenom=$prenom;
		$this->email=$email;
		$this->mdp=$mdp;
	}

	/**
	 * Ajoute un utilisateur en BDD
	 */
	public function ajouter()
	{
		include("connexionBDD.php");
		
		$requete = "insert into utilisateur (mail, nom, prenom, motDePasse,solde, rang ) values('$this->email','$this->nom','$this->prenom','".$this->cryptMdp($this->mdp)."', 0, 0)";

		$exec=$connexion->exec($requete);

		//include("fermetureBD.php");
		return($exec);

	}

	public static function existe($mail,$map)
	{
		include("connexionBDD.php");
		$requete = "select idUtilisateur from utilisateur where mail = $mail and MotdePasse = ".$this->cryptMdp($mdp);

		$exec=$connexion->query($requete);
		var_dump($exec);
		return($exec);

	}

	public function cryptMdp($mdp)
	{
		return sha1($mdp);
	}

	/**
	 * Vérifie si les données existes
	 * (les champs existent, et sont valide)
	 */
	public static function existDonnees($utilisateur) 
	{
		return isset($utilisateur['nom']) && !empty($utilisateur['nom'])
			&& isset($utilisateur['prenom']) && !empty($utilisateur['prenom'])
			&& isset($utilisateur['email']) && !empty($utilisateur['email'])
			&& isset($utilisateur['mdp']) && !empty($utilisateur['mdp'])
			&& isset($utilisateur['cmdp']) && !empty($utilisateur['cmdp']);
	}

	/**
	 * Vérifie si les données sont valides
	 * @return null  si aucune erreurs
	 *         array d'erreur indexé par les champs
	 */
	public static function validDonnees($utilisateur) 
	{
		$erreurs = array();

		if(strlen($utilisateur['mdp']) < 5)
			$erreurs['mdp'] = 'Le mot de passe doit avoir 5 caractères minimum';

		if($utilisateur['mdp'] !== $utilisateur['cmdp'])
			$erreurs['cmdp'] = 'Les mots de passe sont différents';

		if(!eregi(".*@.*\.[A-z]{1,4}", $utilisateur['email']))
			$erreurs['email'] = "L'email n'est pas valide";

		return (sizeof($erreurs) == 0) ? null : $erreurs;
	}

	public  function __toString()
	{
		return strtoupper($this->nom) . ' ' . ucfirst($this->prenom) ;
	}
}

