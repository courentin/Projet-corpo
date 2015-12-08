<div class="page-header">
  <h1>Inscription</h1>
</div>
<div class="row">
	<form method="POST" action="" class="col-md-6">
		<?php
		$form = new FormHelper('inscription', array(
			'defaultValues' => $_POST,
			'errors'        => isset($err) ? $err : false
		));
		echo $form->input('nom');
		echo $form->input('prenom');
		echo $form->input('email', [ 'type' => 'email' ]);
		echo $form->input('mdp', [ 'type' => 'password', 'label' => 'Mot de passe' ]);
		echo $form->input('cmdp', [ 'type' => 'password', 'label' => 'Confirmation' ]);
		?>

		<?php if(isset($err['global'])) echo '<p class="alert alert-danger">' . $err['global'] . '</p>'; ?>
		<input type="submit" class="btn btn-primary" value="S'inscrire">
	</form>
</div>