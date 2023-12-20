<?php

class Controller_D extends Controller {

    
    public function action_deleteFilm(){
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

   
    public function action_redirection(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idFilm = isset($_POST['idFilm']) ? $_POST['idFilm'] : '';

            $m = Model::getModel();
            $film = $m->getFilmById($idFilm);

            if (!$m->getIdExist($idFilm)) {
            // Le film avec cet ID n'existe pas
            $message = "Il n'y a pas de Film avec l'ID " . $idFilm . "!";
            header("Location: ?controller=R&action=default");
            }
        }
            
            $data = [
                'title' => 'Confirmation de suppression',
                'idFilm' => $idFilm,
                'titre' => $film['titre'],
            ];

            $this->render('confirmation', $data);
        
    }
    

    public function action_confirmDelete(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifiez la valeur du champ "confirmation"
            $confirmation = isset($_POST['confirmation']) ? $_POST['confirmation'] : '';

            if ($confirmation === 'oui') {
                // Suppression du Film
                $idFilm = isset($_POST['idFilm']) ? $_POST['idFilm'] : '';
                $m = Model::getModel();
                $suppression = $m->getDeleteFilm($idFilm);

                if ($suppression) {
                    $message = "Le Film a été supprimé.";
                } else {
                    $message = "Il n'y a pas de Film avec l'ID $idFilm !";
                }

                $data = [
                    "title" => "Suppression d'un Film.",
                    "delete" => $message,
                ];

                $this->render("delete", $data);

            } elseif ($confirmation === 'non') {
                // L'utilisateur a choisi de ne pas supprimer le Film
                // Redirection vers la page où l'on saisit l'ID
                header("Location: ?controller=D&action=default");

            } else {
                // La valeur du champ "confirmation" n'est ni "oui" ni "non"
                $message = "Choix invalide dans le formulaire !";

                $data = [
                    "title" => "Erreur",
                    "error" => $message,
                ];

                $this->render("error", $data);
            }
        }
    }

    
    public function action_default(){
       
        $this->action_deleteFilm();
    }

}

?>