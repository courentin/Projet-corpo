<h1>Mon compte</h1>
<h3><?= strtoupper ( $_SESSION['utilisateur']['nom'] ) . " " . ucfirst($_SESSION['utilisateur']['prenom']); ?></h3>
<p></p>
<?php
echo "email";

?>

<h1>Mes dernières commandes</h1>
<table class="table">
	<tr>
		<th>Commande n°</th>
		<th>Date</th>
		<th>Montant</th>
	</tr>
</table>
