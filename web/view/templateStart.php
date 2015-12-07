<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
	<title>Corpo<?php if(defined('TITRE')) echo ' - '.TITRE?></title>
	<link rel="stylesheet" href="../public/bootstrap.css" />
</head>
<body>



<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= App::route('index/') ?>">Corpo</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
           <li class="active"><a href="<?= App::route('compte/') ?>">
           <?php 
            if(isset($_SESSION['utilisateur'])) echo strtoupper($_SESSION['utilisateur']['nom']) . " ".ucfirst($_SESSION['utilisateur']['prenom']) ?>
           <span class="sr-only">(current)</span></a></li>
          <li><a href="#">Carte</a></li>
          <li><a href="#">Commande</a></li>
          <li><a href="<?= App::route('utilisateurs/') ?>" >Gestion utilisateurs</a></li>

        
      </ul>

      <?php if(isset($_SESSION['utilisateur'])): ?>
      <a href="<?= App::route('compte/deconnexion') ?>" type="button" class="btn btn-default navbar-btn">Deconnexion</a href="">
      <?php else: ?>
      <a href="<?= App::route('compte/identification') ?>" type="button" class="btn btn-default navbar-btn">S'identifier</a>
      <a href="<?= App::route('compte/inscription') ?>" type="button" class="btn btn-default navbar-btn">S'inscrire</a>
      <?php endif; ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>



<div class="container" style="margin-top:50px">