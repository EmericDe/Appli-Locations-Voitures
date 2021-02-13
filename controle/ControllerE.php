<?php

// Action -> connecteA qui affiche l'espace Client
function connecteA(){
    require_once("./modele/Client.php");
}

// Action -> deconnexion qui permet de se déconnecter
function deconnexion(){
    session_unset();
    session_destroy();
    require("./controle/Controller.php");
    index();
}

// Action -> louer qui va créer une facture vide contenant les identifiants du client et du véhicule
function louer(){
    if(count($_POST) ==  0) require("./vue/entreprises/entreprises.tpl");
    else{
        require("./modele/fonctions.php");
        require("./modele/connexion.php");
        // On vérifie que le bouton 'louerV' a été appuié
        if(isset($_POST['louerV'])){
            // On vérifie qu'une case a été cochée
            if(isset($_POST['cocher'])){
                $id = $_SESSION['id'];
                $idV = $_POST['cocher'];
                louerVoiture($id, $idV);
                // On change la disponibilité du véhicule en réservé
                changerLocation($idV);
                // Redirection page de l'espace
                $url ="index.php?controle=ControllerE&action=connecteA&id=$id";
                header("Location:".$url);
            } else {
                echo " Vous n'avez pas coché le véhicule que vous vouliez louer.";
            }

        }
     }
}

// Action -> SpecifierV qui va mettre à jour les dates de location d'un véhicule
function SpecifierV(){
    if(count($_POST) == 0) require("./vue/entreprises/entreprises.tpl");
    else {
        require("./modele/fonctions.php");
        require("./modele/connexion.php");
        if(isset($_POST['spe-btn'], $_POST['nomSpe'], $_POST['dateD'], $_POST['dateF'])){
            if(empty($_POST['nomSpe'])){
                echo "Vous n'avez pas choisi le véhicule pour lequel vous souhaitez préciser les dates de location";
            }
            elseif(empty($_POST['dateD'])){
                echo"La date de début de location n'a pas été précisée.";
            }
            else {
                // Si le champ de la date de fin est vide, alors on attribue une valeur nulle à ce champ
                if(empty($_POST['dateF'])) $dateF = '0000-00-00';
                specifier($typeE, $dateD, $dateF);
                $id = $_SESSION['id'];
                // Redirection page de l'espace
                $url ="index.php?controle=ControllerE&action=connecteA&id=$id";
                header("Location:".$url);
            }
        }
    }
}

?>