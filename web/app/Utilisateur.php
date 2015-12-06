<?php 

class Utilisateur {
	private $id    = false;
	private $rang  = Rang::NON_ADHERENT;
	private $solde = null;
	private $prenom;
	private $nom;
	private $mdp;
	private $email;
	
	public function __construct($id = false)
	{
		if($id) {
			$db = App::getDatabase();
			$user = $db->query('SELECT * FROM utilisateur JOIN rang ON idRang = rang WHERE idUtilisateur = ?', [ $id ])->fetch(PDO::FETCH_ASSOC);
			if(!$user) throw new InvalidArgumentException();

			$rang = new Rang();
			$rang->setId($user['idrang'])
			     ->setLabel($user['nomrang'])
			     ->setReduction($user['reduction']);

			$this->setId($user['idutilisateur'])
			     ->setEmail($user['mail'])
			     ->setNom($user['nom'])
			     ->setPrenom($user['prenom'])
			     ->setMdp($user['motdepasse'])
			     ->setSolde($user['solde'])
			     ->setRang($rang);
		}
	}

	/**
	 * Ajoute ou met a jour un utilisateur en BDD
	 */
	public function save()
	{
		$db = App::getDatabase();
		try {
			if($this->id) { // UPDATE

			} else { // INSERT
				return $db->query("INSERT INTO utilisateur (mail, nom, prenom, motDePasse, solde, rang) VALUES (?, ?, ?, ?, ?, ?)", [
					$this->getEmail(),
					$this->getNom(),
					$this->getPrenom(),
					$this->cryptMdp($this->mdp),
					$this->getSolde(),
					$this->getRang()->getId()
				]);
			}
		} catch(PDOException $e) {
			return false;
		}
	}
/*

	public static function rechercherParMail($mail)
	{
		include("connexionBDD.php");
		$requete = "select idUtilisateur nom ,prenom, mdp, mail from user where mail='$mail'";
		$exec = $connexion->query($requete);

		$nbLignes = $exec->rowCount();

		if ( $nbLignes < 1)
			return false ;
		else if ( $nbLignes == 1){
			


			$utilisateur = new Utilisateur($exec['nom'],$exec['prenom'],$exec['mail'],$exec['mdp'],);
			return $utilisateur;
		}
		else throw new Exception(); 

		include("fermetureBD.php");

	}	


	public static function existe($mail,$map)
	{
		include("connexionBDD.php");
		$requete = "select idUtilisateur from utilisateur where mail = $mail and MotdePasse = ".$this->cryptMdp($mdp);


		$exec=$connexion->query($requete);
		var_dump($exec);
		return($exec);

	}
*/
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

    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    private function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of rang.
     *
     * @return mixed
     */
    public function getRang()
    {
        return $this->rang;
    }

    /**
     * Sets the value of rang.
     *
     * @param mixed $rang the rang
     *
     * @return self
     */
    private function setRang(Rang $rang)
    {
        $this->rang = $rang;

        return $this;
    }

    /**
     * Gets the value of solde.
     *
     * @return mixed
     */
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * Sets the value of solde.
     *
     * @param mixed $solde the solde
     *
     * @return self
     */
    private function setSolde($solde)
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * Gets the value of prenom.
     *
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Sets the value of prenom.
     *
     * @param mixed $prenom the prenom
     *
     * @return self
     */
    private function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Gets the value of nom.
     *
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Sets the value of nom.
     *
     * @param mixed $nom the nom
     *
     * @return self
     */
    private function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Gets the value of mdp.
     *
     * @return mixed
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Sets the value of mdp.
     *
     * @param mixed $mdp the mdp
     *
     * @return self
     */
    private function setMdp($mdp)
    {
        $this->mdp = $mdp;

        return $this;
    }

    /**
     * Gets the value of email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param mixed $email the email
     *
     * @return self
     */
    private function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}
