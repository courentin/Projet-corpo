<?php
define('TITRE', 'Inscription');
include_once('view/templateStart.php');
?>
<div class="row">
	<h1>Inscription</h1>
	<form method="POST" action="inscriptionController.php" class="col-md-6">
		<?php
		$err = isset($err) ? $err : [];
		echo FormHelper::input('nom', [ 'errors' => $err ]);
		echo FormHelper::input('prenom', [ 'errors' => $err ]);
		echo FormHelper::input('email', [ 'errors' => $err, 'type' => 'email' ]);
		echo FormHelper::input('mdp', [ 'errors' => $err, 'type' => 'password', 'label' => 'Mot de passe' ]);
		echo FormHelper::input('cmdp', [ 'errors' => $err, 'type' => 'password', 'label' => 'Confirmation' ]);
		?>

		<?php if(isset($err['global'])) echo '<p class="alert alert-danger">' . $err['global'] . '</p>'; ?>
		<input type="submit" class="btn btn-primary" value="S'inscrire">
	</form>
</div>
<?php include_once('view/templateEnd.php'); ?>
