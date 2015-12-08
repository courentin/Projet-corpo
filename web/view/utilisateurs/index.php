<div class="page-header">
  <h1>Liste des utilisateurs</h1>
</div>
<table id="liste_utilisateurs" class="table table-striped" >
	<thead>
		<tr>
			<th>Nom</th>
			<th>Prenom</th>
			<th>Mail</th>
			<th>Solde</th>
			<th>Rang</th>
			<th>Demande d'adhesion</th>
			<th>Modifier</th>
			<th>Débloquer</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($utilisateurs as $utilisateur): ?>
		<tr>
			<td><?= $utilisateur['nom'] ?></td>
			<td><?= $utilisateur['prenom'] ?></td>
			<td><?= $utilisateur['mail'] ?></td>
			<td><?= $utilisateur['solde'] ?> €</td>
			<td><?= $utilisateur['nomrang'] ?></td>
			<td>
		<?php if($utilisateur['iddemande'] !== null && $utilisateur['statut'] == 2) : ?>
			<a class="btn btn-success" href="<?= App::route('utilisateurs/valideradhesion/'.$utilisateur['idutilisateur'].'/1') ?>">Valider</a>
			<a class="btn btn-danger" href="<?= App::route('utilisateurs/valideradhesion/'.$utilisateur['idutilisateur'].'/0') ?>">Refuser</a>
		<?php elseif($utilisateur['statut'] === 0): ?>
			<span class="text-danger">Demande refusée</span>
		<?php else: ?>
			Pas de demande
		<?php endif; ?>
			</td>
			<td><a class="btn btn-primary" href="<?= App::route('utilisateurs/editer/'.$utilisateur['idutilisateur']) ?>">Modifier</a></td>
			<td>
		<?php if($utilisateur['try'] <= 0): ?>
			<a class="btn btn-warning" href="<?= App::route('utilisateurs/debloquer/'.$utilisateur['idutilisateur']) ?>">Débloquer</a>
		<?php endif; ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>