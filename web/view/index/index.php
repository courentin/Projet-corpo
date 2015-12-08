<div class="page-header">
  <h1>Bienvenue <small>Site de la Corpo</small></h1>
</div>
<div class="row">
	<ul class="list-group col-md-4">
	<h2>Membres de la Corpo</h2>
	<?php foreach ($mambres as $membre) {
	  echo '<li class="list-group-item"><strong>'.strtoupper($membre['nom']).' '.ucfirst($membre['prenom']).'</strong><span class="pull-right">'.$membre['nomrang'].'</span></li>';
	}
	?>
	</ul>
</div>