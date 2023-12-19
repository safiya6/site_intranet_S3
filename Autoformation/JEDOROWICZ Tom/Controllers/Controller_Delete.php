<?php

class Controller_Delete extends Controller {

    // Cette méthode est appelée lors de la soumission du formulaire de suppression
    public function action_SuppressionFilm() {
        if (isset($_POST["idFilm"]) && preg_match("/^[1-9]\d*$/", $_POST["idFilm"])) {
            $id = $_POST["idFilm"];
            $m = Model::getModel();
            if ($m->getDeleteFilm($id)) {
                $message = "Le film a été supprimé.";
            } else {
                $message = "Aucun film trouvé avec l'ID " . $id . ".";
            }
        } else {
            $message = "ID invalide ou non fourni.";
        }

        $this->render("delete", ["title" => "Suppression d'un film", "delete" => $message]);
    }

    // Cette méthode pourrait être utilisée pour afficher une page de confirmation avant la suppression
    public function action_predelete() {
        if (isset($_POST['confirmDelete']) && $_POST['confirmDelete'] == '1') {
            $this->action_SuppressionFilm(); // Appel direct à la suppression si confirmé
        } else {
            // Logique pour gérer la non-confirmation
        }
    }

    public function action_default() {
        $this->action_SuppressionFilm();
    }

}

?>
