<?php
/**
* 
*/
class Produits extends Controller
{	
	public function ajouterProduit()
	{
		$db = App::getDatabase();
		$categorie = $db->query('Select idcategorieproduit, nomcategorieproduit from categorieproduit');
		$result = $categorie->fetchAll(PDO::FETCH_ASSOC);
		$catproduit = array();

		foreach ($result as $cat) {
			$catproduit[$cat['nomcategorieproduit']] = $cat['idcategorieproduit'];
		}

			if($_SERVER['REQUEST_METHOD'] === 'POST') 
			{
					$data = $_POST['ajouterProduit'];
					$req = $db->query('Insert into Produit Values (default,?,?,?,?)' , array($data['nomproduit'],$data['prix'],$data['stock'],$data['categorieProduit']));

					$success = "Produit ".$data['nomproduit']." ajouté !";
					unset($_POST['ajouterProduit']);
		    }

		$this->render('ajouterProduit', array(
		    	'catproduit' => $catproduit,
		    	'success' => isset($success) ? $success : null
		    ));
	}
			
}