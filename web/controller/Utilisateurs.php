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