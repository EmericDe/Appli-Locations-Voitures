<?php 
// On démarre la session chaque fois que le fichier est appelé
session_start();

	// Cela va nous permettre de récupérer les bons controleurs et les bonnes actions nécessaires
	// au fonctionnement du site
	if(isset($_GET['controle']) & isset($_GET['action'])) {
		$controle = $_GET['controle'];
		$action = $_GET['action'];
	}
	else {
		$controle="Controller";
		$action="index";
	}
	require('./controle/'.$controle.'.php');
	$action();
	
	// Fonction afficherDescription
	// qui va nous permettre de pouvoir afficher tous nos véhicules présents dans notre stock
	// vu d'ensemble de tous les véhicules du loueur
	function afficherDescription(&$profil){
		require("./modele/connectBD.php");
		$sql = "SELECT *FROM vehicule ORDER BY id_v ASC";
		$commande = $pdo->prepare($sql);
		$commande->execute();
		$profil = $commande->fetchAll();
	}
	


?>

