<?php
/**
* 
*/
class Produits extends Controller
{	
	public function ajouterProduit()
	{
		$db = App::getDatabase();
		$categorie = $db->query('Select nomcategorieproduit from categorieproduit');
		$catproduit = $categorie->fetchAll(PDO::FETCH_COLUMN);
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
echo "<br/>";
var_dump($catproduit);
			if($_SERVER['REQUEST_METHOD'] === 'POST') 
			{

					$req = $db->query('Insert into Produit Values (default,?,?,?,?)' , array($nomProduit,$prix,$stock,$catProduit));

					if (sizeof($req) == 1)
				    {
					  $this->redirect('produits/index/');
				    }

		    }

		$this->render('ajouterProduit', array(
		    	'catproduit' => $catproduit
		    ));
	}
			
}