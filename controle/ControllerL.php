<?php

// Action -> connecteL qui affiche l'espace loueur
function connecteL(){
    require_once("./modele/Loueur.php");
}

// Action -> deconnexion qui permet de se déconnecter
function deconnexion(){
    session_unset();
    session_destroy();
    require("./controle/Controller.php");
    index();
}

// Action -> ajoutV 
// qui va nous permettre d'ajouter un véhicule au stock
function ajoutV(){
    if(count($_POST) == 0) require("./vue/loueur/loueur.tpl");
    else {
        require("./modele/fonctions.php");
        require("./modele/connexion.php");
        $msg = '';
        // On vérifie l'existence des champs puis on vérifie certaines conditions
        if (isset($_POST['add-btn'], $_POST['typev'], $_POST['energie'], $_POST['boite'],$_POST['location'])){
            if(empty($_POST['typev'])){
                echo"<div class='alert alert-danger' role='alert'> Le nom du véhicule n'a pas été renseigné<div>";
            }
            elseif(empty($_POST['energie'])){
                echo"<div class='alert alert-danger' role='alert'> Le type d'énergie du véhicule n'a pas été renseigné.<div>";
            }
            elseif(empty($_POST['boite'])){
                echo"<div class='alert alert-danger' role='alert'> Le type de boîte de vitesse du véhicule n'a pas été renseigné.<div>";
            }
            elseif(strlen($_POST['typev']) > 30){
                echo"<div class='alert alert-danger' role='alert'> Le nom du véhicule contient plus de 30 caractères.<div>";
            }
            elseif(empty($_POST['photo'])){
                echo "Vous n'avez pas ajouté la photo";
            }
            else {
                if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['typev']) && !empty($_POST['energie']) && !empty($_POST['boite']) && !empty($_POST['location']) && !empty($_POST['places']) && !empty($_POST['photo'])){
                    $idl = $_SESSION['idl'];
                    echo "<pre>", print_r($_FILES['photo']), "</pre>";
                    $photo_test = "./vue/Photo/" . $_POST['photo'];
                    ajouterVoiture($typev, $energie, $boite, $nbplaces, $location, $photo_test);
                    // Redirection vers l'espace
                    $url ="index.php?controle=ControllerL&action=connecteL&id=$idl";
                    header("Location:".$url);
                }
            }
        }
    }
}

// Action -> retrait 
//qui va permettre de retirer un véhicule du stock de véhicule
function retrait(){
    if(count($_POST) == 0) require("./vue/loueur/loueur.tpl");
    else {
        require("./modele/fonctions.php");
        require("./modele/connexion.php");
        // On vérifie que le champ contenant le nom du véhicule ne soit pas vide
        if(!empty($_POST['retraitnom'])){
            $idl = $_SESSION['idl'];
            retraitVoiture($type);
            $url ="index.php?controle=ControllerL&action=connecteL&id=$idl";
            header("Location:".$url);
        }
    }
}

?>