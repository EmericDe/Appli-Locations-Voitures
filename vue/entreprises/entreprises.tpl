<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./vue/StyleCSS/entreprise.css"/>
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
        				<a class="nav-link" href="index.php?controle=Controller&action=index&id=$id">Home</a>
      				</li>
      				<li class="nav-item">
        				<a class="nav-link" href="index.php?controle=Controller&action=inscript&id=$id">S'inscrire</a>
      				</li>
      				<li class="nav-item">
						<a class="nav-link" href="index.php?controle=ControllerE&action=deconnexion">Se déconnecter</a>
					</li>
    			</ul>
  			</div>
		</nav>
        <h2> Bienvenue dans votre espace abonné <?php echo $_SESSION['nom']; ?></h2>
		<div id="tableau">
		<table class=" table table-striped">
			<thead>
			<tr>
			<th>Nom du véhicule</th>
			<th>Type de moteur</th>
			<th>Type de boîte de vitesse</th>
			<th>Disponibilité des véhicules</th>
			<th>Date de début de location</th>
			<th>Date de fin de location</th>
			</tr>
			</thead>
			<tbody>
				<?php if($voituresl != false){
				foreach($voituresl as $voitures): ?>
				<tr>
				<td><?= $voitures['type_v'] ?></td>
				<td><?= $voitures['energie_v'] ?></td>
				<td><?= $voitures['boite_v'] ?></td>
				<td><?= $voitures['location_v'] ?></td>
				<td><?= $voitures['dateD']?></td>
				<td><?= $voitures['dateF']?></td>
				</tr>
				<?php endforeach; } else echo "Vous n'avez pas de véhicules loués"; ?>
			</tbody>
		</table>
	</div>
	<input type="checkbox" id="click">
    <label for="click" class="show">Spécifier les dates pour un véhicule</label>
    <div class="specifier" id="forma">
	<?php if($voituresR != false){ ?>
        <form action="index.php?controle=ControllerE&action=SpecifierV" method="post">
            <label for="click" class="close-btn fas fa-times"></label>
            <h3 style="font-size: 16px; text-align: center;">Spécifier les dates de location d'un véhicule pour finaliser sa location</h3>
            <select name="nomSpe" size="1">
            <?php foreach($voituresR as $voiturer):?>
            <option><?= $voiturer['type_v']?>
            <?php endforeach; ?>
            </select>
			<input class="input-x" placeholder="yyyy-mm-dd" type="date" name="dateD" value=""/></br>
			<input class="input-box" placeholder="yyyy-/mm-dd" type="date" name="dateF" value="" /></br>
            <input type="submit" class="spe-btn" name="spe-btn" value="Spécifier">
        </form>
		<?php } else echo "Vous n'avez pas réservé de véhicules"; ?>
	</div>
		<h2>Retrouvez ici la liste des véhicules disponibles à la location</h2>
		<h6>Réservez dès maintenant vos véhicules, vous êtes Roi !!</h6>
		<?php if($voituresD != false){ ?>
		<div id="tableau">
		<table class=" table table-striped">
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
				<?php foreach($voituresD as $voitures): ?>
				<tr>
				<td><img style="width:150px; height:150px;"src="<?= $voitures['photo_v'] ?>"></td>
				<td><?= $voitures['type_v'] ?></td>
				<td><?= $voitures['energie_v'] ?></td>
				<td><?= $voitures['boite_v'] ?></td>
				<td><?= $voitures['places_v'] ?></td>
				<form action="index.php?controle=ControllerE&action=louer" method="post">
				<td><input type="checkbox" name="cocher" value="<?php echo $voitures['id_v'];?>" ></td>
				<td><input type="submit" class="louerV" name="louerV" value="louer"></td>
				</form>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php } else echo"Il n'y a pas de véhicules disponibles"; ?>
	</body>
</html>