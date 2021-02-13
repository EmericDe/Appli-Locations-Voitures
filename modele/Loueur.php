<?php

// Les variables nécessaires au bon fonctionnement de nos fonctions
// elles fotn aussi référence à des valeurs contenus dans nos tpl
$noml = isset($_POST['nom']) ? $_POST['nom'] : '';
$emaill = isset($_POST['email']) ? $_POST['email'] : '';
$mdpl = isset($_POST['mdpl']) ? $_POST['mdpl'] : '';

// Ici on retrouve toutes les fonctions qui doivent 
// être chargés lorsqu'on fait appel au fichier
$vehicules = array();
$voitures = array();
$vlocations = array();
  afficherStock($voitures);
  afficherLocation($vlocations);
  afficherVehiculesDPR($vehicules);
  require("./vue/loueur/loueur.tpl");

// Fonction affciherVehiculesDPR
// qui va permettre de faire afficher tous les véhicules disponibles 
// pour effectuer un retrait
function afficherVehiculesDPR(&$vehicules){
	require("./modele/connectBD.php");
	$sql = "SELECT *FROM vehicule WHERE vehicule.location_v='disponible' ORDER BY id_v ASC";
	$commande = $pdo->prepare($sql);
	$commande->execute();
    $vehicules = $commande->fetchAll();
}

// Fonction afficherStock
// qui va nous permettre de faire afficher tous les véhicules
// que l'on a dans le stock peut importe s'ils sont loués ou disponibles ou en révision
function afficherStock(&$voitures){
    require("./modele/connectBD.php");
	$sql = "SELECT *FROM vehicule ORDER BY id_v ASC";
	$commande = $pdo->prepare($sql);
	$commande->execute();
    $voitures = $commande->fetchAll();
    
}

// Fonction afficherLocation
// qui va nous permettre de faire afficher les véhicules loués
// que possèdent chacun des clients 
function afficherLocation(&$vlocations){
	require("./modele/connectBD.php");
	$sql ="SELECT vehicule.*, client.*, facturation.* FROM facturation JOIN vehicule ON facturation.idv = vehicule.id_v JOIN client ON facturation.ide = client.id_c WHERE vehicule.location_v = 'loué' ORDER BY client.nom_c";
	$commande = $pdo->prepare($sql);
	$commande->execute();
	$vlocations = $commande->fetchAll();
}

?>