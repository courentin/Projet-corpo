<?php
define('TITRE', 'Inscription');
?>
<div class="row">
	<h1>Ajouter produit</h1>
	<form method="POST" action="" class="col-md-6">
		<?php
		$form = new FormHelper('ajouterProduit', array(
			'defaultValues' => $_POST,
			//'errors'        => $err 
		));

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