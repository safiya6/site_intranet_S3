<?php

class Controller_connexion extends Controller
{
    public function action_default(){

        $this->action_connexion();

    }
    public function action_connexion() {
        $m = Model::getModel();
        if (isset($_POST["ide"]) && isset($_POST["mdp"])) {


            if ($m->est_connecte($_POST["ide"], $_POST["mdp"])) {
                $donnee = $m->recuperer_donnee($_POST["ide"]);
                session_start();
                $_SESSION["prenom"] = $donnee["prenom"];
    
                if($m ->est_secretaire($_POST["ide"]) ){

                 
                    $_SESSION["role"] = "secrétaire";
                }
                elseif ($m ->est_directeur($_POST["ide"])){
                  
                    $_SESSION["role"] = "directeur";
                }
                else{
                    
                    $_SESSION["role"] = "enseignant";}
                
                    header('Location: page_identifiant.php');
                   
            } else {
               header('Location: page_error.php');
    
            }
            
        } else{
            $this->render("form_connect", $_POST);
        }
    }


 
}
?>