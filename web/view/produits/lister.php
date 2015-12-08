<div class="page-header">
  <h1>Liste des produits</h1>
</div>
<table id="liste_produits" class="table table-striped" >
	<thead>
		<tr>
			<th>Nom</th>
			<th>Prix</th>
			<th>Catégorie</th>
			<th>Modifier</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($produits as $produit): ?>
		<tr>
			<td><?= $produit['nom'] ?></td>
			<td><?= $produit['prix'] ?></td>
			<td><?= $produit['categorie'] ?></td>
			<td><a class="btn btn-primary" href="<?= App::route('produits/editer/'.$produit['idproduit']) ?>">Modifier</a></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

