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

			$db = App::getDatabase();
			if(strlen($mail) != 0 && strlen($MDP) != NULL ) {
			
				$req = $db->query('select mail, idutilisateur,nom,prenom,solde,rang, try, motdepasse from Utilisateur  
	                                   where mail  = ?', array($mail));
			
				$resultat = $req->fetchAll(PDO::FETCH_ASSOC);

				if (sizeof($resultat) == 1) {
					if($resultat[0]['try'] > 0) {
						if($resultat[0]['motdepasse'] == Utilisateur::cryptMdp($MDP)) {
							$_SESSION['utilisateur'] = $resultat[0];
							$req = $db->query('update utilisateur set try = 3 where mail = ?', array($mail));
							$this->redirect('compte');
						} else { // mdp non correct
							$req = $db->query('update utilisateur set try = try - 1 where mail = ?', array($mail));
							$err['global'] = $resultat[0]['try']." tentatives restantes";
						}
					} else {
						$err['global'] = "Compte bloqué";
					}
				} else {
					$err['global'] = "Identifiants incorrects";
				}
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
		Autorisation::autoriser('connect', 'compte/identification/');
		$db = App::getDatabase();
		$query = $db->query('SELECT idcommande, datecommande, SUM(commandeproduit.quantite*produit.prix) as montant
			                 FROM commande
			                 JOIN commandeproduit ON commande.idcommande = commandeproduit.produit
			                 JOIN produit ON produit.idproduit = commandeproduit.commande
			                 WHERE utilisateur = ?
			                 GROUP BY idcommande
			                 ORDER BY datecommande DESC
			                 LIMIT 10', array(
			$_SESSION['utilisateur']['idutilisateur']
		));
		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		$demande = $db->query('SELECT statut FROM demandecarte WHERE idutilisateur = ?', array($this->getUser()['idutilisateur']))
				 ->fetch(PDO::FETCH_COLUMN);

		$this->render('index', [
			'commandes' => $result,
			'statutDemande' => $demande
		]);
	}

	public function demandeAdhesion()
	{
		Autorisation::nePasAutoriser(Rang::ADHERENT, 'compte/');
		if($_SESSION['utilisateur']['idrang'] == Rang::NON_ADHERENT){
			$db = App::getDatabase();
			$db->query('INSERT INTO DemandeCarte values (default, ?, NULL, 2)', array(
				$_SESSION['utilisateur']['idutilisateur']
			));
		}

		$this->redirect('compte/index');
	}
}