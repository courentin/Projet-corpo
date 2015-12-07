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
				$this->redirect('compte');
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
		$this->redirect('compte/identification');
	}

	public function index()
	{

		$db = App::getDatabase();

		$query = $db->query('select idcommande from commande where utilisateur = ? limit 10', array(
			$_SESSION['utilisateur']['idutilisateur']
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
}