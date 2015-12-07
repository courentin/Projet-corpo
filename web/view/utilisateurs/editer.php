	<h1>Inscription</h1>
	<form method="POST" action="" class="col-md-6">
		<?php
		$form = new FormHelper('editer_utilisateur', array(
			'defaultValues' => isset($_POST['editer_utilisateur']) ? $_POST : $utilisateur,
			'errors'        => isset($err) ? $err : false
		));
		echo $form->input('nom');
		echo $form->input('prenom');
		echo $form->input('mail', [ 'type' => 'email' ]);
		echo $form->input('solde', [ 'type' => 'number']);
		//echo $form->select('rang');
		?>

		<?php if(isset($err['global'])) echo '<p class="alert alert-danger">' . $err['global'] . '</p>'; ?>
		<input type="submit" class="btn btn-primary" value="Enregistrer">
	</form>