<!doctype html>
<html>
	<head>
		<meta charset="utf-8">	
		<link rel="stylesheet" href="./vue/StyleCSS/loueur.css"/>
		<link rel="stylesheet" href="./vue/StyleCSS/bootstrap.css"/>
		<script src="https://kit.fontawesome.com/228973d50f.js" crossorigin="anonymous"></script>
		<title>Locars</title>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  		<a class="navbar-brand" href="index.php?controle=Controller&action=index&idl=$idl">Locars</a>
		<div class="collapse navbar-collapse" id="navbarColor02">
    		<ul class="navbar-nav mr-auto">
      			<li class="nav-item active">
        			<a class="nav-link" href="index.php?controle=Controller&action=index&idl=$idl">Home</a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="index.php?controle=Controller&action=inscript&idl=$idl">S'inscrire</a>
      			</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php?controle=ControllerL&action=deconnexion">Se déconnecter</a>
				</li>
    		</ul>
  		</div>
		</nav>
		<h2>Bienvenue dans votre espace administrateur <?php echo $_SESSION['noml'] ?></h2>
		<h4>Voici la liste de vos véhicules</h4>
		<div id="tableau">
		<table class=" table table-striped">
			<thead>
			<tr>
			<th>Nom du véhicule</th>
			<th>Type de moteur</th>
			<th>Type de boîte de vitesse</th>
			<th>Nombre de places</th>
			<th>Disponibilité des véhicules</th>
			</tr>
			</thead>
			<tbody>
				<?php foreach($voitures as $voiture): ?>
				<tr>
				<td><?= $voiture['type_v'] ?></td>
				<td><?= $voiture['energie_v'] ?></td>
				<td><?= $voiture['boite_v'] ?></td>
				<td><?= $voiture['places_v'] ?></td>
				<td><?= $voiture['location_v'] ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<input type="checkbox" id="click">
	<label for="click" class="show">Ajouter un véhicule</label>
	<input type="checkbox" id="clickr" >
    <label for="clickr" class="showr">Retirer un véhicule</label>
	<div class="ajoutf" id="forma" name="formulaire">
	<form action="index.php?controle=ControllerL&action=ajoutV" method="post"> 
            <label for="click" class="close-btn fas fa-times"></label>
            <h3>Ajouter un véhicule</h3>
            <input class="input-box" placeholder="Nom du véhicule" type="text" name="typev" value="" /></br>
            <select name="energie">
            <option value=""> Type de moteur </option>
            <option value="électrique"> électrique </option>
            <option value="hybride"> hybride </option>
            </select></br>
            <select name="boite">
            <option value="">Type de boîte de vitesse </option>
            <option value="manuelle">manuelle </option>
            <option value="automatique">automatique </option>
            </select></br>
			<input class="input-box" placeholder="Nombre de places" type="text" name="places" value="" /></br>
            <select name="location">
            <option value="Disponible">Disponible </option>
            <option value="en_révision">en_révision </option>
            </select></br>
            <input class="input-box" placeholder="Joindre un fichier" type="file" name="photo"/></br>
            <button type="submit" class="add-btn" name="add-btn" value="Ajouter">Ajouter</button>
        </form>
	</div>
    <div class="retirerV" id="forma">
        <form action="index.php?controle=ControllerL&action=retrait" method="post">
            <label for="clickr" class="close-btn fas fa-times"></label>
            <h3>Retirer un véhicule</h3>
            <select name="retraitnom" size="1">
            <?php foreach($voitures as $voiturer):?>
            <option><?= $voiturer['type_v']?>
            <?php endforeach; ?>
            </select>
            <input type="submit" class="supp-btn" name="supp-btn" value="Retirer">
        </form>
	</div>
	<h4> Voici la liste des voitures louées par les clients </h4>
	<div id="tableau">
		<table class="table table-striped">
			<thead>
			<tr>
			<th>Nom de l'entreprise</th>
			<th>Nom du véhicule</th>
			<th>Type de moteur</th>
			<th>Type de boîte de vitesse</th>
			<th>Disponibilité des véhicules</th>
			<th>Date de début de location</th>
			<th>Date de fin de location</th>
			</tr>
			</thead>
			<tbody>
				<?php foreach($vlocations as $vlocation): ?>
				<tr>
				<td><?= $vlocation['nom_c']?></td>
				<td><?= $vlocation['type_v'] ?></td>
				<td><?= $vlocation['energie_v'] ?></td>
				<td><?= $vlocation['boite_v'] ?></td>
				<td><?= $vlocation['location_v'] ?></td>
				<td><?= $vlocation['dateD'] ?></td>
				<td><?= $vlocation['dateF'] ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	</body>
</html>