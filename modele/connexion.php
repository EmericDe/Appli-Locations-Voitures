<?php
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : '';

// Fonction verificationC
// qui va permettre de vérifier que les identifiants d'un client
// soit bien présent dans la base de données
    function verificationC($email, $mdp, &$profil){
        require("./modele/connectBD.php");
        $sql = "SELECT *FROM  client where email_c= :email and mdp_c= :mdp";
        try {
            $commande = $pdo->prepare($sql);
            $commande->bindParam(':email', $email, PDO::PARAM_STR);
            $commande->bindParam(':mdp', $mdp, PDO::PARAM_STR);
            $commande->execute();
            if (($commande->rowCount()) > 0) {
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
// Fonction verificationL
// qui va permettre de vérifier que les identifiants d'un loueur
// soit bien présent dans la base de données
    function verificationL($email, $mdp, &$profill){
        require("./modele/connectBD.php");
        $sql = "SELECT *FROM  loueur where email_l = :email and mdp_l = :mdp";
        try {
            $commande = $pdo->prepare($sql);
            $commande->bindParam(':email', $email, PDO::PARAM_STR);
            $commande->bindParam(':mdp', $mdp, PDO::PARAM_INT);
            $commande->execute();
            if (($commande->rowCount()) > 0) {
                $profill = $commande->fetchAll();
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