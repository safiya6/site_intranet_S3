<?php


class Controller_connexion extends Controller
{
    public function action_default() {
        $this->action_connexion();
    }

    public function action_connexion() {
        $m = Model::getModel();
        $error_message = '';  // Variable pour stocker le message d'erreur

        // Si le formulaire est soumis
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ide"]) && isset($_POST["mdp"])) {
            if ($m->est_connecte($_POST["ide"], $_POST["mdp"])) {
                $donnee = $m->recuperer_donnee($_POST["ide"]);
                
                $_SESSION["prenom"] = $donnee["prenom"];

                if ($m->est_secretaire($_POST["ide"])) {
                    $_SESSION["role"] = "secrétaire";
                } elseif ($m->est_directeur($_POST["ide"])) {
                    $_SESSION["role"] = "directeur";
                } else {
                    $_SESSION["role"] = "enseignant";
                }

                // Effectuez des opérations supplémentaires dans le modèle si nécessaire

                // Redirigez vers la vue après la soumission du formulaire
                $this->render("page_identifiant", $_POST);
                return;
            } else {
                // Stockez le message d'erreur
                $error_message = 'Identifiant ou mot de passe incorrect';
            }
        }

        // Affichez le formulaire de connexion avec le message d'erreur si nécessaire
        $this->render("form_connect", ['error_message' => $error_message]);
    }
}
?>
