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
		$this->render('inscription', ['err' => isset($err) ? $err : array()]);
	}



	public function identification()
	{
		$err = [];
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$mail = $_POST['identification']['email'];
			$MDP = $_POST['identification']['MDP'];

			if(strlen($mail) != 0 && strlen($MDP) != NULL ) {
				$db = App::getDatabase();
			
				$req = $db->query('select mail, idutilisateur,nom,prenom,solde,rang from Utilisateur  
	                                   where mail  = ?
	                                   and motdepasse = ? ', array($mail,
	                                   	Utilisateur::cryptMdp($MDP)
	                                   	));
			
				$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
				var_dump($resultat);
	        }

			if (sizeof($resultat) == 1) {
				$_SESSION['utilisateur'] = $resultat[0];
				$this->redirect('');
			} else {
				$err['global'] = "Identifiants incorrects";
			}
		}


		$this->render('identification', [
			'err' => $err
		]);
	}

	public function deconnexion()
	{
		unset($_SESSION['utilisateur']);
	}

	public function index()
	{
		$db = App::getDatabase();

		$query = $db->query('select idcommande from commande where idutilisateur = ? limit 10', array(
			$_SESSION['utilisateur']['idutilisateur'];
		));
		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		$this->render('index', [
			'commandes' => $result
		]);
	}
/*
	public function demandeAdhesion()
	{
		if($utilisateur->$rang == NON_ADHERENT){
			
			$db = App::getDatabase();
			$db->query('INSERT INTO DemandeCarte values (default, ?)', array(
				$_SESSION['utilisateur']['idutilisateur']
			));
		}



		$this->redirect('/compte/index');
	}
	*/

		
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