<?php
/**
* 
*/
class Utilisateurs extends Controller
{
	public function __construct() {}

	public function index(){
		Autorisation::autoriser(Rang::BUREAU, 'compte/identification');

		$db = App::getDatabase();
		$req = $db->query('SELECT * FROM utilisateur LEFT JOIN demandeCarte USING(idUtilisateur) JOIN rang ON rang.idrang = utilisateur.rang ORDER BY nom ASC');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);
		$this->render('index', [
			'utilisateurs' => $result
		]);
	}

	public function editer($idUtilisateur)
	{
		Autorisation::autoriser(Rang::MEMBRE, 'compte/identification');

		$err = [];
		$db = App::getDatabase();
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$datas = $_POST['editer_utilisateur'];
			$req = $db->query('UPDATE utilisateur SET mail = ?, solde = ?, rang = ? WHERE idUtilisateur = ?', array(
				$datas['mail'],
				$datas['solde'],
				$datas['rang'],
				$idUtilisateur
			));
			
			if(!$req) $err['global'] = "Erreur interne";
			$this->redirect('utilisateurs/index/');
		}

		$req = $db->query('SELECT * FROM Utilisateur WHERE idUtilisateur = ?', array($idUtilisateur));
		$result['editer_utilisateur'] = $req->fetch(PDO::FETCH_ASSOC);

		$rangsq = $db->query('SELECT idrang, nomrang FROM rang')->fetchAll(PDO::FETCH_ASSOC);
		$rangs = array();
		foreach ($rangsq as $rang) {
			$rangs[$rang['nomrang']] = $rang['idrang'];
		}

		$this->render('editer', [
			'utilisateur' => $result,
			'rangs' => $rangs,
			'err' => $err
		]);
	}

	public function debloquer($idutilisateur)
	{
		Autorisation::autoriser(Rang::PRESIDENT, 'compte/identification');
		$db = App::getDatabase();
		$req = $db->query('UPDATE utilisateur SET try = 3 WHERE idutilisateur = ?', array($idutilisateur));
		if(!$req) $err['global'] = "Erreur interne";
		$this->redirect('utilisateurs/index/');
	}

	/**
	* /utilisateurs/valideradhesion/1/1
	*/
	public function valideradhesion($id,$status)
	{
		Autorisation::autoriser(Rang::MEMBRE, 'compte/identification');

		$idValideur = $_SESSION['utilisateur']['idutilisateur'];

		if(strlen($id) != 0 && strlen($status) != 0) { 
		$db = App::getDatabase();
		
		$req2 = $db->query('update demandecarte set 
								   statut = ? ,
								   idvalideur = ? 
                                   where idutilisateur  = ? ', array($status,$idValideur,$id));
		}

		if (sizeof($req2) == 1) {
			$this->redirect('utilisateurs/index');
		}
	}
} 