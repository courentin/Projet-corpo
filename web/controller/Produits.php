<?php
/**
* 
*/
class Produits extends Controller
{	


	public function index()
	{
		$db = App::getDatabase();
		$listproduit = $db->query('SELECT nomproduit, prix, nomcategorieproduit FROM produit JOIN categorieproduit ON produit.categorieproduit=categorieproduit.idcategorieproduit ');
		$result = $listproduit->fetchAll(PDO::FETCH_ASSOC);

		$this->render('listerProduit', array( 'produits' => $result ));

	}






















	public function ajouter()
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
	
	public function editer($idProduit)
	{
		$db = App::getDatabase();

		$produit = $db->query('Select * from produit where idproduit = ?', array($idProduit));
		$resultp['editerProduit'] = $produit->fetch(PDO::FETCH_ASSOC);
		$this->render('editerProduit', [
			'produitmodif' => $resultp
		]);

		var_dump($resultp);

		$categorie = $db->query('Select idcategorieproduit, nomcategorieproduit from categorieproduit');
		$result = $categorie->fetchAll(PDO::FETCH_ASSOC);
		$catproduit = array();

		foreach ($result as $cat) {
			$catproduit[$cat['nomcategorieproduit']] = $cat['idcategorieproduit'];
		}


			if($_SERVER['REQUEST_METHOD'] === 'POST') 
			{
					$data = $_POST['ajouterProduit'];
					$req = $db->query('Update Produit set nomProduit = ?,
														  prix = ?,
														  stock = ?,
														  categorieProduit = ?' , 
										array($data['nomproduit'],$data['prix'],$data['stock'],$data['categorieProduit']));

					$success = "Produit ".$data['nomproduit']." modifié !";
		    }

		$this->render('editerProduit', array(
		    	'catproduit' => $catproduit,
		    	'resultp' => $resultp,
		    	'success' => isset($success) ? $success : null
		    ));
	}		
}