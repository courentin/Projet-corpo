<div class="row">
	<h1>Ajouter catégorie</h1>
	<form method="POST" action="" class="col-md-6">
		<?php
		$form = new FormHelper('ajouterCategorie', array(
			'defaultValues' => $_POST,
			//'errors'        => $err 
		));

		echo $form->input('nomcategorieproduit', ['label' => 'Nom Catégorie']);
		
		?>
		<?php if(isset($success)) echo '<p class="alert alert-success">' . $success.'</p>'; ?>
		<?php if(isset($err['global'])) echo '<p class="alert alert-danger">' . $err['global'] .'</p>'; ?>
		<input type="submit" class="btn btn-primary" value="Enregistrer">
	</form>
</div>