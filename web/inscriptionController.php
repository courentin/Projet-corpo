<?php

require_once 'include.php';
define('INSCRIPTION_VIEW', 'view/inscription.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	if(Utilisateur::existDonnees($_POST)) {
		$err = Utilisateur::validDonnees($_POST);
		if($err == null) {
			$utilisateur = new Utilisateur($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp']);
			
			if($utilisateur->ajouter()) {
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
