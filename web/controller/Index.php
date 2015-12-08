<?php 
/**
* 
*/
class Index extends Controller
{

	public function __construct() {}

	public function index() {
		$db = App::getDatabase();
		$req = $db->query('SELECT nom, prenom, mail, nomrang FROM utilisateur JOIN rang ON utilisateur.rang = rang.idrang where rang<=2 ORDER BY nom ASC');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		$this->render('index', array(
			'mambres' => $result
		));
	}
}