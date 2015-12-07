<?php
/**
* 
*/
class Utilisateurs extends Controller
{
	public function __construct()
	{
		# code...
	}

	public function index(){
		$db = App::getDatabase();
		$req = $db->query('SELECT * FROM utilisateur LEFT JOIN demandeCarte USING(idUtilisateur) ORDER BY nom ASC');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);
		$this->render('index', [
			'utilisateurs' => $result
		]);
	}

	public function listeMembres()
	{
		$db = App::getDatabase();
		$req = $db->query('SELECT nom, prenom, mail, rang FROM utilisateur where rang<=2 ORDER BY nom ASC');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);
		/*$this->render('index', [
			'utilisateurs' => $result
		]);*/
		/*Affichage à faire*/
	}

	public function editer($idUtilisateur)
	{
		$err = [];
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$idUtilisateur = $_POST['utilisateurs']['idUtilisateur'];
		}

		$db = App::getDatabase();
		$req = $db->query('SELECT * FROM Utilisateur WHERE idUtilisateur = ?', array($idUtilisateur));
		$result['editer_utilisateur'] = $req->fetch(PDO::FETCH_ASSOC);
		$this->render('editer', [
			'utilisateur' => $result
		]);
	}

	/**
	* /utilisateurs/valideradhesion/1/1
	*/
	public function valideradhesion($id,$status)
	{
		$idValideur = $_SESSION['utilisateur']['idutilisateur'] ;

	  if(strlen($id) != 0 && strlen($status) != 0)

	   { 
		$db = App::getDatabase();
		
		$req2 = $db->query('update demandecarte set 
								   statut = ? ,
								   idvalideur = ? 
                                   where idutilisateur  = ? ', array($status,$idValideur,$id));
	   }


	 if (sizeof($req2) == 1)
	  {
		$this->redirect('utilisateurs/index');
	  }
	}
}