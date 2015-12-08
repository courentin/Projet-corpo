	<h1>Editer un utilisateur</h1>
	<form method="POST" action="" class="col-md-6">
		<?php
		$form = new FormHelper('editer_utilisateur', array(
			'defaultValues' => isset($_POST['editer_utilisateur']) ? $_POST : $utilisateur,
			'errors'        => isset($err) ? $err : false
		));
		echo $form->input('nom', [ 'readonly' => true ]);
		echo $form->input('prenom', [ 'readonly' => true ]);
		echo $form->input('mail', [ 'type' => 'email' ]);
		echo $form->input('solde', [ 'type' => 'money']);
		echo $form->select('rang', $rangs, [ 'defaultValue' => $utilisateur['editer_utilisateur']['rang'] ]);
		?>

		<?php if(isset($err['global'])) echo '<p class="alert alert-danger">' . $err['global'] . '</p>'; ?>
		<input type="submit" class="btn btn-primary" value="Enregistrer">
	</form>