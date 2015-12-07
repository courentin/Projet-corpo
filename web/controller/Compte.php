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
		$this->render('inscription', [
			'err' => $err
		]);
	}

	public function index()
	{
		$this->render('index');
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