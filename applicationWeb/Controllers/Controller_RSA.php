<?php
require './Utils/keys.php';
require_once './Utils/RSAmodule.php';

// Récupération des clés
$privKey = PRIVATE_KEY;
$pubKey = PUBLIC_KEY;

class Controller_RSA extends Controller
{
    public function action_chiffrerBDD(){
        global $pubKey;
        $etat = 0;
        $bdd = 0;

        $m = Model::getModel();

        // Vérification de la méthode HTTP et de l action 'chiffrer'
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'chiffrer') {
            // On récupère les identifiants
            $tab = $m->recuperer_id();
            $taille = verifMdp($tab);
            $resultat = $m->chiffrerToutMdp($taille, $tab, $pubKey);
            $etat = $m->isChiffre();
            //variable utilisé a des fins de debug dans une page spécial permettant de chiffrer/dechiffrer toute la bdd
            if ($resultat === 1) {
                $bdd = "succes";
            } else {
                $bdd = "skipped";
            }

            // tableau de données à passer à la vue et rendu de la vue
            $data = ["etat" => $etat, "bdd" => $bdd];
            $this->render("RSA", $data);
        }

        // Mise à jour du tableau de données et rendu de la vue en cas de non-chiffrement
        $data = ["etat" => $etat, "bdd" => $bdd];
        $this->render("RSA", $data);
    }

    // Action pour déchiffrer les données en base de données
    public function action_dechiffrerBDD(){
        global $privKey;
        // Initialisation des variables de facons a toujours retourner quelque chose meme en cas d'Erreur
        $etat = 0;
        $bdd = 0;

        // Traitement des actions de l'utilisateur
        $m = Model::getModel();

        // Vérification de la méthode HTTP et de l'action 'dechiffrer'
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'dechiffrer') {
            // Récupération des identifiants
            $tab = $m->recuperer_id();
            // Vérification et récupération de la taille des mots de passe
            $taille = verifMdp($tab);
            // Déchiffrement de tous les mots de passe
            $resultat = $m->dechiffrerToutMdp($taille, $tab, $privKey);
            // Vérification de l'état du chiffrement
            $etat = $m->isChiffre();

            // Détermination du statut de la base de données en fonction du résultat
            if ($resultat === 1) {
                $bdd = "succes";
            } else {
                $bdd = "skipped";
            }
        }

        // Construction du tableau de données à passer à la vue et rendu de la vue
        $data = ["etat" => $etat, "bdd" => $bdd];
        $this->render("RSA", $data);
    }

    // Action par défaut
    public function action_default() {
        // cet action ne fait que diriger vers la vue RSA sans rien faire, l'utilisateur fait son choix sur cette derniere
        $this->render("RSA");
    }
}
?>
