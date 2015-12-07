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

	public function identification()
	{
		$mail = $_POST[‘identification’][‘email’];
		$MDP = $_POST[‘identification’][‘MDP’];

	  if(strlen($email) != 0 && strlen($MDP) != NULL )

	   { 
		$db = App::getDatabase();
		
		$req = $db->query(“select Email, idutilisateur,nom,prénom,solde,rang from Utilisateur  
                                   where Email  = ?
                                   and PASSWORD = ? ”, array(
			$_POST['MAIL’],
			$_POST['MDP']
		));
		$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
   
           }

	 if (sizeof($resultat) == 1)
	  {
		session_start();
            	$_SESSION[‘utilisateur’] = $resultat;
		
	  }
		$this->render(‘identification’);
	}
}