<?php

class Controller_connexion extends Controller
{
    // Action par défaut qui redirige vers l'action de connexion
    public function action_default() {
        $this->action_connexion();
    }

    // Action de gestion de la connexion
    public function action_connexion() {
        $m = Model::getModel();
        $error_message = '';

        session_start();

        // Si une session est déjà active elle est détruite
        if (!empty($_SESSION)){
            session_unset();
            session_destroy();
        } 

        // Si le formulaire est soumis
        if (isset($_POST["ide"]) && isset($_POST["mdp"])) {
            
            if ($m->est_connecte($_POST["ide"], $_POST["mdp"])) {
                $donnee = $m->recuperer_donnee($_POST["ide"]);

                // Initialise les variables de session
                $_SESSION["ide"] = (int)$_POST["ide"];
                $_SESSION["prenom"] = $donnee["prenom"];
                $_SESSION["semestre"] = 1;
                $_SESSION["niveau"] = 1; 

                // Détermine le rôle de l'utilisateur et redirige en conséquence
                if ($m->est_secretaire($_POST["ide"])) {
                    $_SESSION["role"] = "secretaire";
                    header('Location: ?controller=page&action=secretaire');
                    exit();
                } elseif ($m->est_directeur($_POST["ide"])) {
                    $_SESSION["role"] = "directeur";
                    header('Location: ?controller=page&action=directeur');
                    exit(); 
                } elseif ($m->est_equipedirection($_POST["ide"])) {
                    $_SESSION["role"] = "equipedirection";
                    header('Location: ?controller=page&action=directeur');
                    exit(); 
                } elseif ($m->est_chefdepartement($_POST["ide"])) {
                    $_SESSION["role"] = "chef de departement";
                    header('Location: ?controller=page&action=chefDept');
                    exit();
                } else {
                    $_SESSION["role"] = "enseignant";
                    header('Location: ?controller=page&action=enseignant');
                    exit();
                }
            } else {
                // Stocke le message d erreur en cas de mauvais identifiant ou mot de passe 
                $error_message = 'Identifiant ou mot de passe incorrect';
            }
        }

        // Affiche le formulaire de connexion avec le message d'erreur si nécessaire
        $this->render("form_connect", ['error_message' => $error_message]);
    }

    // Actions pour les différents rôles (en commentaire pour le moment)
    /*public function action_enseignant()
    {
        $_SESSION["role"] = "enseignant";  
    }

    public function action_secretaire()
    {
        $_SESSION["role"] = "secretaire";
    }

    public function action_chefDept()
    {
        $m = Model::getModel();
        $_SESSION["role"] = "chef de departement";
        $_SESSION["departement"] = $m->recup_departement($_POST["ide"]); 
    }

    public function action_directeur()
    {
        $_SESSION["role"] = "directeur";
    }*/
}

?>
