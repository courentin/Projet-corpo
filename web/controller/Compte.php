<?php
/**
* 
*/
class Compte extends Controller
{
	
	public function inscription()
	{
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			if(Utilisateur::existDonnees($_POST['inscription'])) {
				$err = Utilisateur::validDonnees($_POST['inscription']);
				if($err == null) {
					$datas = $_POST['inscription'];
					$utilisateur = new Utilisateur();
					$utilisateur->setNom($datas['nom'])
					            ->setPrenom($datas['prenom'])
					            ->setEmail($datas['email'])
					            ->setMdp($datas['mdp']);

					if($utilisateur->save()) {
						echo "Utilisateur $utilisateur enregistré !";
					} else {
						$err['global'] = 'Erreur interne';
					}
				}
			} else {
				$err['global'] = 'Tous les champs doivent être complétés';
			}
		}
		$this->render('inscription', ['err' => $err]);
	}



	public function identification()
	{
		$mail = $_POST['identification']['email'];
		$MDP = $_POST['identification']['MDP'];

	  if(strlen($mail) != 0 && strlen($MDP) != NULL )

	   { 
		$db = App::getDatabase();
		
		$req = $db->query('select mail, idutilisateur,nom,prenom,solde,rang from Utilisateur  
                                   where mail  = ?
                                   and motdepasse = ? ', array($mail,$MDP));
		
		$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
   
           }

	 if (sizeof($resultat) == 1)
	  {
		session_start();
        $_SESSION['utilisateur'] = $resultat;
		
	  }
		$this->render('identification');
	}

	/**
	* /compte/valideradhesion/1/Valide
	*/
	public function valideradhesion($id,$status)
	{
		//$idValideur = $_SESSION['utilisateur']['idutilisateur'] ;
		$idValideur=1;

	  if(strlen($id) != 0 && strlen($status) != 0)

	   { 
		$db = App::getDatabase();
		
		$req = $db->query('update demandecarte set 
								   status = ? 
								   valideur = ? 
                                   where idutilisateur  = ? ', array($status,$idValideur,$id));
	   }


	 if (sizeof($resultat) == 1)
	  {
		$this->redirect('utilisateurs/index');
	  }
	
	}

}