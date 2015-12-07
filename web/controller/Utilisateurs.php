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
		$req = $db->query('SELECT * FROM utilIsateur ORDER BY nom ASC');
		$result = $req->fetchAll(PDO::FETCH_ASSOC);

		$this->render('index', [
			'utilisateurs' => $result
		]);
	}

}