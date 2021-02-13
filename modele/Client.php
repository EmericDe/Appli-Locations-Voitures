<?php

// Les variables nécessaires au bon fonctionnement de nos fonctions
// elles fotn aussi référence à des valeurs contenus dans nos tpl
$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';
$typev = isset($_POST['typev']) ? $_POST['typev'] : '';
$dateD = isset($_POST['dateD']) ? $_POST['dateD'] : '';
$dateF = isset($_POST['dateF']) ? $_POST['dateF'] : '';
$voituresl = array();
$voituresD = array();
$voituresR = array();
$ide = (isset($_GET['id'])) ? $_GET['id'] : $_SESSION['profil']['id_c'];

// Ici on retrouve toutes les fonctions qui doivent 
// être chargés lorsqu'on fait appel au fichier
afficherFlotteV($ide,$voituresl);
afficherFlotteDisp($voituresD);
afficherFlotteReserv($ide,$voituresR);
$_SESSION['voitures'] = $voituresD;
$_SESSION['voituresR'] = $voituresR;
require("./vue/entreprises/entreprises.tpl");


// Fonction afficherFlotteV 
// va nous permettre d'afficher toute la flotte de véhicules loués par le client 
function afficherFlotteV($ide,&$voituresl){
    require("./modele/connectBD.php");
    $sql ="SELECT vehicule.*, facturation.* FROM facturation INNER JOIN vehicule ON facturation.idv = vehicule.id_v WHERE facturation.ide = '$ide' and vehicule.location_v= 'loué' ORDER BY vehicule.type_v";
    $commande = $pdo->prepare($sql);
    $commande->execute();
    $voituresl = $commande->fetchAll();
}

// Fonction afficherFlotteDisp
// va nous permettre d'afficher toute la flotte de véhicules
// disponibles à la location
function afficherFlotteDisp(&$voituresD){
    require("./modele/connectBD.php");
    $sql ="SELECT  *FROM vehicule where location_v='disponible' ORDER BY type_v ASC" ;
    $commande = $pdo->prepare($sql);
    $commande->execute();
    $voituresD = $commande->fetchAll();
}

// Fonction afficherFlotteReserv
// va nous permettre de récupérer tous les véhicules qu'un client 
// aura réservé pour la location
function afficherFlotteReserv($ide,&$voituresR){
    require("./modele/connectBD.php");
    $sql="SELECT vehicule.*, facturation.* FROM vehicule INNER JOIN facturation ON vehicule.id_v = facturation.idv WHERE facturation.ide ='$ide' and vehicule.location_v = 'réservé' ORDER BY vehicule.type_v";
    $commande = $pdo->prepare($sql);
    $commande->execute();
    $voituresR = $commande->fetchAll();
}

?>