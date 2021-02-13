<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./vue/StyleCSS/accueil.css"/>
		<link rel="stylesheet" href="./vue/StyleCSS/bootstrap.css"/>
		<!-- <script src="script.js"></script> -->
		<title>Locars</title>
	</head>
	<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php?controle=Controller&action=index">Locars</a>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php?controle=Controller&action=index">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controle=Controller&action=inscript">S'inscrire</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?controle=Controller&action=connexion">Se connecter</a>
      </li>
    </ul>
  </div>
</nav>
	<h2>Bienvenue sur Locars: site de locations pour particuliers</h2>
	<h4> Voici la description des véhicules</h4>
	<div id="tableau">
		<table class="table table-striped">
			<thead>
			<tr>
			<th>Photo du véhicule</th>
			<th>Nom du véhicule</th>
			<th>Type de moteur</th>
			<th>Type de boîte de vitesse</th>
			<th>Nombre de places</th>
			</tr>
			</thead>
			<tbody>
				<?php foreach($profil as $profils): ?>
				<tr>
				<td> <img style="width:100px; height:100px;"src="<?= $profils['photo_v'] ?>"></td>
				<td><?= $profils['type_v'] ?></td>
				<td><?= $profils['energie_v'] ?></td>
				<td><?= $profils['boite_v'] ?></td>
				<td><?= $profils['places_v'] ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	</body>
</html>