<div class="row">
	<h1>Editer produit</h1>
	<form method="POST" action="" class="col-md-6">
		<?php
		$form = new FormHelper('editerProduit', array(
			'defaultValues' => !empty($_POST['editerProduit']) ? $_POST : $resultp
			//'errors'        => $err 
		));?>
<table id="produit_modifiable" class="table" >
	<tr>
		<th>Nom produit</th>
		<th>Prix</th>
		<th>Stock</th>
		<th>Catégorie produit</th>
	</tr>
<?php	
		echo "<tr>";
		echo "<td>".$produitmodif['nomProduit']."</td>";
		echo "<td>".$produitmodif['prix']."</td>";
		echo "<td>".$produitmodif['stock']."</td>";
		echo "<td>".$produitmodif['categorieProduit']."</td>";
		echo "</tr>";
?>		
</table>
<?php
		echo $form->input('nomproduit', ['label' => 'Nom Produit']);
		echo $form->input('prix' ,[ 'type' => 'number' ]);
		echo $form->input('stock', [ 'type' => 'number' ]);


		echo $form->select('categorieProduit',$catproduit, ['label' => 'Catégorie Produit']);
		?>
		<?php if(isset($success)) echo '<p class="alert alert-success">' . $success.'</p>'; ?>
		<?php if(isset($err['global'])) echo '<p class="alert alert-danger">' . $err['global'] .'</p>'; ?>
		<input type="submit" class="btn btn-primary" value="Enregistrer">
	</form>
</div>