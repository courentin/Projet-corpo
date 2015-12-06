<?php

require_once 'include.php';
define('INSCRIPTION_VIEW', 'view/inscription.php');
$_SESSION['idUtilisateur'] = 21;

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

include(INSCRIPTION_VIEW);
