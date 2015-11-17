<?php
define('TITRE', 'Inscription');
include_once('view/templateStart.php'); ?>
<h1>Inscription</h1>
<form method="POST" action="inscriptionController.php">
	<div> 
		<label>Nom</label>
		<input name="nom" type="text">
		<?php if(isset($err['nom'])) echo $err['nom']; ?>
	</div>
	<div>
		<label>Prenom</label>
		<input name="prenom" type="text">
		<?php if(isset($err['prenom'])) echo $err['prenom']; ?>
	</div>
	<div>
		<label>Email</label>
		<input name="email" type="email">
		<?php if(isset($err['email'])) echo $err['email']; ?>
	</div>
	<div>
		<label>Mot de passe</label>
		<input name="mdp" type="password">
		<?php if(isset($err['mdp'])) echo $err['mdp']; ?>
	</div>
	<div>
		<label>Confirmation mdp</label>
		<input name="cmdp" type="password">
		<?php if(isset($err['cmdp'])) echo $err['cmdp']; ?>
	</div>
	<?php if(isset($err['global'])) echo $err['global']; ?>
	<br/>
	<input type="submit" value="S'inscrire">
</form>
<?php include_once('view/templateEnd.php'); ?>
