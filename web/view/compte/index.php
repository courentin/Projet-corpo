<h1>Mon compte</h1>
<h3><?= strtoupper ( $_SESSION['utilisateur']['nom'] ) . " " . ucfirst($_SESSION['utilisateur']['prenom']); ?> <span class="label label-default"><?= $_SESSION['utilisateur']['solde'] ?> €</span></h3>

<?php if($statutDemande === false): ?>
<a class="btn btn-primary" href="<?= App::route('compte/demandeAdhesion/') ?>">Demande d'adhesion</a>
<?php elseif($statutDemande === 2): ?>
<em>En attente d'adhesion</em>
<?php elseif($statutDemande === 0): ?>
<em class="text-danger">Demande d'adhesion refusée</em>
<?php endif; ?>
<h1>Mes dernières commandes</h1>
<?php if(sizeof($commandes) > 0): ?>
<table class="table">
	<thead>
		<tr>
			<th>Commande n°</th>
			<th>Date</th>
			<th>Montant</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($commandes as $commande): ?>
		<tr>
			<td><?= $commande['idcommande'] ?></td>
			<?php $commande['datecommande'] = new DateTime($commande['datecommande']); ?>
			<td><?= $commande['datecommande']->format('d/m/Y à H\hi') ?></td>
			<td><?= $commande['montant'] ?> €</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<?php else: ?>
	<h2>Aucune commande :(</h2>
<?php endif; ?>