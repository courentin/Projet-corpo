<?php
define('TITRE', 'Inscription');
include_once('view/templateStart.php');
?>
<div class="row">
	<h1>Inscription</h1>
	<form method="POST" action="inscriptionController.php" class="col-md-6">
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
<?php include_once('view/templateEnd.php'); ?>
