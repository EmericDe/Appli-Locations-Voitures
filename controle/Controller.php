<?php
// Voici notre premier controller qui va nous permettre 
// d'effectuer les actions comme l'inscription, la connexion ou encore revenir à l'accueil

// Action-> index va nous permettre d'afficher toutes les descriptions des véhicules du loueur
function index(){
    if(count($_POST) == 0) {
        afficherDescription($profil);
        require("./vue/accueil.tpl");
    }
    else{
        require("./index.php");
    }
}

// Action -> connexion va nous permettre de nous connecter à notre espace abonné ou loueur
function connexion(){
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';
    $profil = array();
    $profill = array();
    if (count($_POST) == 0) require("./vue/connexion.tpl");
    else {
        require("./modele/connexion.php");
        $msg = '';
        if(isset($_POST['email'], $_POST['mdp'])){
            // On vérifie que les champs ne soient pas vides.
            if(empty($_POST['email']) && empty($_POST['mdp'])) {
               die("Champs non remplis");
               $msg = "Champs non remplis";
            }
            elseif (empty($_POST['email'])){
                die("Vous n'avez pas rentré votre adresse mail.");
                $msg = "Vous n'avez pas rentré votre adresse mail";
            }
            elseif(empty($_POST['mdp'])){
                die("Vous n'avez pas rentré votre mot de passe.");
                $msg = "Vous n'avez pas rentré votre mot de passe";
            }
            else {
                if(!verificationC($email,$mdp,$profil) && !verificationL($email,$mdp,$profil)) {
                    die("L'identifiant et/ou le mot de passe sont pas bons");
                    $msg = "L'identifiant et/ou le mot de passe ne sont pas bons";
                }
                // On vérifie que la connexion à l'espace loueur existe et on souhaite pouvoir se connecter à son compte
                elseif(verificationL($email,$mdp,$profill)){
                    $idl ='';
                    $_SESSION['profill'] = $profill;
                    foreach ($profill as $pr):
                        $idl = $pr[0];
                        $nom = $pr[1];
                    endforeach;
                    $_SESSION['idl'] = $idl;
                    $_SESSION['noml'] = $nom;
                    // On renvoie à l'espace en tant que connecté "loueur"
                    $url ="index.php?controle=ControllerL&action=connecteL&id=$idl";
                    header("Location:".$url);
                }
                // On vérifie que la connexion à l'espace abonné existe et on souhaite pouvoir se connecter à son compte
                elseif(verificationC($email,$mdp,$profil)) {
                    $id ='';
                    $_SESSION['profil'] = $profil;
                    foreach ($profil as $p):
                        $id = $p[0];
                        $nom = $p[1];
                    endforeach;
                    $_SESSION['id'] = $id;
                    $_SESSION['nom'] = $nom;
                    // On renvoie à l'espace en tant que connecté "abonné"
                    $url ="index.php?controle=ControllerE&action=connecteA&id=$id";
                    header("Location:".$url);

                }
            }
        }
    }

}

// Action -> inscription qui va s'actionner quand le bouton du formulaire inscription
// et qui va enregistrer les informations de la personne 
// en utilisant la fonction ajout_inscription de fonctions.php
function inscript(){
    $nom = isset($_POST['nom']) ? $_POST['nom'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';
    $profil = array();
    $msg ='';
    if (count($_POST) == 0) require("./vue/entreprises/inscription.tpl");
    else {
        require("./modele/fonctions.php");
        $profil = array();
        if (isset($_POST['nom'],$_POST['email'], $_POST['mdp'])) {
            if (empty($_POST['nom'])) {
                echo"<div class='alert alert-warning' role='alert'>Votre nom n'a pas été renseigné</div>";
                $msg = "Votre nom n'a pas été renseigné";
            } elseif (empty($_POST['email'])) {
                echo"<div class='alert alert-warning' role='alert'>Votre adresse mail n'a pas été renseigné</div>";
                $msg = "Votre adresse mail n'a pas été renseigné";
            } elseif (empty($_POST['mdp'])) {
                echo"<div class='alert alert-warning' role='alert'>Votre mot de passe n'a pas été défini</div>";
                $msg = "Votre mot de passe n'a pas été défini";
            } elseif (strlen($_POST['nom']) > 20) {
                echo"<div class='alert alert-warning' role='alert'>Votre nom contient plus de 20 caractères</div>";
                $msg = "Votre nom contient plus de 20 caractères";
            } elseif (!preg_match("#^[a-z0-9]+$#", $_POST['nom'])) {
                echo"<div class='alert alert-wa' role='alert'>Le nom doit être renseigné par des lettres minuscules sans accents, sans caractères spéciaux.</div>";
                $msg = "Le nom doit être renseigné par des lettres minuscules sans accents, sans caractères spéciaux";
            } elseif (strlen($_POST['mdp']) < 9) {
                echo"<div class='alert alert-warning' role='alert'>Votre mot de passe est trop court. Il doit être supérieur à 9 caractères.</div>";
                $msg = "Votre mot de passe est trop court. Il doit être supérieur à 9 caractères";
            } elseif (empty($_POST['mdp'])) {
                echo"<div class='alert alert-warning' role='alert'>Le champ mot de passe est vide.</div>";
                $msg = " Le champ mot de passe est vide";
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                echo"<div class='alert alert-warning' role='alert'>Votre adresse mail n'est pas valide.</div>";
                $msg = "Votre adresse mail n'est pas valide";
            } elseif (verif_ident($email, $mdp, $profil)) {
                echo"<div class='alert alert-warning' role='alert'>Vous êtes déjà inscrits.</div>";
                $msg = "Vous êtes déjà inscrits";
            } else {
                ajout_inscription($nom, $email, $mdp);
                if(verif_ident($email,$mdp,$profil)){
                    $id ='';
                    $nom ='';
                    $_SESSION['profil'] = $profil;
                    foreach ($profil as $p):
                        $id = $p[0];
                        $nom = $p[1];
                    endforeach;
                    $_SESSION['id'] = $id;
                    $_SESSION['nom'] = $nom;
                    $url ="index.php?controle=ControllerE&action=connecteA&id=$id";
                    header("Location:".$url);
                }

            }
        }
    }
}

?>