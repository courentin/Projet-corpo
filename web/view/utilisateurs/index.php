<table id="liste_utilisateurs" class="table" >
	<tr>
		<th>Nom</th>
		<th>Prenom</th>
		<th>Mail</th>
		<th>Solde</th>
		<th>Rang</th>
		<th>Demande d'adhesion</th>
	</tr>
	<?php 
	foreach ($utilisateurs as $utilisateur) {
		echo "<tr>";
		echo "<td>".$utilisateur['nom']."</td>";
		echo "<td>".$utilisateur['prenom']."</td>";
		echo "<td>".$utilisateur['mail']."</td>";
		echo "<td>".$utilisateur['solde']."€</td>";
		echo "<td>".$utilisateur['rang']."</td>";
		if($utilisateur['rang']['iddemande'] !== null)
			echo "<td><a href=''>valider</a> - <a href=''>refuser</a></td>";
		else
			echo "<td>Pas de demande</tr>";
		echo "</tr>";
	}
	?>
</table>