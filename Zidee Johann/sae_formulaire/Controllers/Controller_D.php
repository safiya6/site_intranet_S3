<?php

class Controller_D extends Controller {

    


    public function action_SuppressionFilm(){
        if (isset($_POST["idFilm"]) and preg_match("/^[1-9]\d*$/", $_POST["idFilm"])) {
            $id = $_POST["idFilm"];

            $m = Model::getModel();
            $suppression = $m->getDeleteFilm($id);
            if ($suppression) {
                $message = "Le Film a était supprimer.";
            } else {
                $message = "Il n'y a pas de Film avec " . $id . "!";
            }
        } else {
            $message = "Il n'y a pas cette id dans l'URL!";
        }

        $data = [
            "title" => "Suppression d'un Film.",
            "delete" => $message,
        ];
        $this->render("delete", $data);
    }

    
    
    public function action_default(){
       
        $this->action_SuppressionFilm();
    }

}



?>