<?php

// Fichier "fonctions" qui va nous permettre de réaliser toutes les actions pour nos deux espaces

// Les variables nécessaires au bon fonctionnement de nos fonctions
// elles fotn aussi référence à des valeurs contenus dans nos tpl
$nom = isset($_POST['nom']) ? $_POST['nom'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';
$typev = isset($_POST['typev']) ? $_POST['typev'] : '';
$energie = isset($_POST['energie']) ? $_POST['energie']: '';
$boite = isset($_POST['boite']) ? $_POST['boite']: '';
$location = isset($_POST['location']) ? $_POST['location']: '';
$nbplaces = isset($_POST['places']) ? $_POST['places']: '';
$photo = isset($_POST['photo']) ? $_POST['photo']: '';
$type = isset($_POST['retraitnom']) ? $_POST['retraitnom']:'';
$idvoitures = isset($_POST['cocher']) ? $_POST['cocher']: '';
$typeE = isset($_POST['nomSpe']) ? $_POST['nomSpe']:'';
$dateD = isset($_POST['dateD']) ? $_POST['dateD']: '';
$dateF = isset($_POST['dateF']) ? $_POST['dateF']: '';


// Fonction retrait qui va permettre au loueur de retirer un véhicule dans le stock de véhicules
function retraitVoiture($type){
	require("./modele/connectBD.php");
	$sql = "DELETE FROM vehicule where vehicule.type_v = '$type'";
	try {
        $commande = $pdo->prepare($sql);
        $commande->execute();
        return true;
    } catch (PDOException $e) {
        echo utf8_encode("Echec de la suppression : " . $e->GetMessage() . "\n");
        die();
    }

}

// Fonction louerVoiture qui va permettre au client de loueur un véhicule en créant une facturation "vide"
// où seulement les ids du véhicule et du client seront enregistrés
function louerVoiture($id,$idvoitures){
    require("./modele/connectBD.php");
    $sql = "INSERT INTO facturation (ide, idv, dateD, dateF, valeur, etat) VALUES ($id, $idvoitures, '0000-00-00','0000-00-00',0,'non_fait')";
    try{
        $commande = $pdo->prepare($sql);
        $commande->execute();
        return true;
    } catch (PDOException $e){
        echo utf8_encode("Echec de l'ajout" .$e->getMessage()."\n");
    }
} 

// Fonction specifier qui va permettre au client de pouvoir spécifier les dates de location d'un véhicule
// en récupérant la facturation du véhicule pour y ajouter les dates de location
function specifier($typeE,$dateD,$dateF){
    require("./modele/connectBD.php");
    $sql="UPDATE facturation INNER JOIN vehicule  ON facturation.idv = vehicule.id_v SET facturation.dateD='$dateD', facturation.dateF='$dateF', vehicule.location_v='loué' WHERE vehicule.type_v='$typeE'";
    try{
        $commande = $pdo->prepare($sql);
        $commande->execute();
        return true;
    } catch (PDOException $e){
        echo utf8_encode("Echec de l'ajout" .$e->getMessage()."\n");
    }
}

// Fonction changerLocation qui est utilisé pour changer la disponibilité du véhicule
// en "réservé" 
function changerLocation($idvoitures){
    require("./modele/connectBD.php");
    $sql = "UPDATE vehicule SET vehicule.location_v = 'réservé' WHERE vehicule.id_v ='$idvoitures'";
    try{
        $commande = $pdo->prepare($sql);
        $commande->execute();
        return true;
    } catch (PDOException $e){
        echo utf8_encode("Echec de l'ajout" .$e->getMessage()."\n");
    }
}

// Fonction ajout_inscription qui va être utilisé pour réaliser une inscription en tant que visiteur
// on récupère les informations de la personne
function ajout_inscription($nom, $email, $mdp)
{
    require("./modele/connectBD.php");
    $sql = "INSERT INTO client (nom_c, email_c, mdp_c) VALUES (:nom, :email, :mdp)";
    try {
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':nom', $nom, PDO::PARAM_STR);
        $commande->bindParam(':email', $email, PDO::PARAM_STR);
        $commande->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        $commande->execute();
        return true;
    } catch (PDOException $e) {
        echo utf8_encode("Echec de select : " . $e->GetMessage() . "\n");
        die();
    }
}
// Fonction verif_ident qui va vérifier que le compte qui vient d'être créé soit bien 
// présent dans la base de données
function verif_ident($email, $mdp, &$profil)
{
    require("./modele/connectBD.php");
    $sql = "SELECT *FROM  client where email_c= :email and mdp_c= :mdp";
    try {
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':email', $email, PDO::PARAM_STR);
        $commande->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        $commande->execute();
        if ($commande->rowCount() > 0) {
            $profil = $commande->fetchAll();
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo utf8_encode("Echec de select : " . $e->GetMessage() . "\n");
        die();
    }
}

// Fonction ajouterVoiture : utiliser dans l'espace loueur pour ajouter 
// un véhicule dans le stock en étant disponible directement mais 
// la disponibilité peut être changer
function ajouterVoiture($typev, $energie, $boite, $nbplaces, $location, $photo){
	require("./modele/connectBD.php");
    $sql = "INSERT INTO vehicule(type_v, energie_v, boite_v, places_v ,location_v, photo_v) VALUES (:type_v, :energie, :boite,:places ,:location_v, :photo)";
    try {
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':type_v', $typev, PDO::PARAM_STR);
        $commande->bindParam(':energie', $energie, PDO::PARAM_STR);
        $commande->bindParam(':boite', $boite, PDO::PARAM_STR);
        $commande->bindParam(':places', $nbplaces, PDO::PARAM_STR);
        $commande->bindParam(':location_v',$location, PDO::PARAM_STR);
        $commande->bindParam(':photo', $photo, PDO::PARAM_STR);
        $commande->execute();
        return true;
    } catch (PDOException $e) {
        echo utf8_encode("Echec de select : " . $e->GetMessage() . "\n");
        die();
    }
    mysqli_close($commande);
}

// Fonction verifVoiture : utilisé pour vérifier qu'un véhicule est bein présent dans la base de données
function verifVoiture($typev, $energie, $boite, $location, &$vehicules){
    require("./modele/connectBD.php");
    $sql= "SELECT *FROM vehicule where type_v = :typev, energie_v = :energie, boite_v = :boite, location_v = :location_v";
    try {
        $commande = $pdo->prepare($sql);
        $commande->bindParam(':typev', $typev, PDO::PARAM_STR);
        $commande->bindParam(':energie', $energie, PDO::PARAM_STR);
		$commande->bindParam(':boite', $boite, PDO::PARAM_STR);
		$commande->bindParam(':location_v',$location, PDO::PARAM_STR);
        $commande->execute();
        if (($commande->rowCount()) > 0) {
            $vehicules = $commande->fetchAll();
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo utf8_encode("Echec de select : " . $e->GetMessage() . "\n");
        die();
    }
}
?>
