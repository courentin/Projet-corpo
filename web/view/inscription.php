<?php
define('TITRE', 'Inscription');
include_once('view/templateStart.php'); ?>
<div class="row">
	<h1>Inscription</h1>
	<form method="POST" action="inscriptionController.php" class="col-md-6">

		<div class="form-group <?php  if(isset($err['nom'])) echo 'has-error'; ?>">		
			<label for="nom" >Nom</label>
			<input id="nom" name="nom" type="text" class="form-control" value="<?php if(isset($_POST['nom'])) echo $_POST['nom']; ?>"  >
			<span id="helpBlock2" class="help-block"><?php if(isset($err['nom'])) echo $err['nom']; ?></span>
		</div>
		<div class="form-group <?php  if(isset($err['prenom'])) echo 'has-error'; ?>">
			<label for="prenom" >Prenom</label>
			<input id="prenom" name="prenom" type="text" class="form-control" value="<?php if(isset($_POST['prenom'])) echo $_POST['prenom']; ?>"   >
			<span id="helpBlock2" class="help-block"><?php if(isset($err['prenom'])) echo $err['prenom']; ?></span>
		</div>
		<div class="form-group <?php  if(isset($err['email'])) echo 'has-error'; ?>">
			<label for="email" >Email</label>
			<input id="email" name="email" type="email" class="form-control" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" >
			<span id="helpBlock2" class="help-block"><?php if(isset($err['email'])) echo $err['email']; ?></span>
		</div>
		<div class="form-group <?php  if(isset($err['mdp'])) echo 'has-error'; ?>">
			<label for="mdp">Mot de passe</label>
			<input id="mdp" name="mdp" type="password" class="form-control" >
			<span id="helpBlock2" class="help-block"><?php if(isset($err['mdp'])) echo $err['mdp']; ?></span>
		</div>
			<div class="form-group <?php  if(isset($err['cmdp'])) echo 'has-error'; ?>">
			<label for="cmdp">Confirmation mdp</label>
			<input id="cmdp" name="cmdp" type="password" class="form-control" >
			<span id="helpBlock2" class="help-block"><?php if(isset($err['cmdp'])) echo $err['cmdp']; ?></span>
		</div>
		<p class="bg-danger">
		<?php if(isset($err['global'])) echo $err['global']; ?>
		</p>

		<input type="submit" class="btn btn-default" value="S'inscrire">
	</form>
</div>
<?php include_once('view/templateEnd.php'); ?>
