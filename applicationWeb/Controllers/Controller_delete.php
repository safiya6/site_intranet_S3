<?php

class Controller_delete extends Controller {

    public function action_formDelete() {
        $m = Model::getModel();
        $data = [
            "personnes"  => $m->getPersonnes(),
        ];
        $this->render("formDeleteEnseignant", $data);
    }

    public function action_deleteEnseignant() {
        if (!empty($_POST['id_personne'])) {
            $infos = $_POST['id_personne'];

            $m = Model::getModel();

            // Supprimer l'enseignant
            $deleteEnseignant = $m->deleteEnseignantEtPersonne($infos);
            if ($deleteEnseignant != false) {
                $data = [
                    'title' => "R�ussi",
                    'message' => "La suppression a �t� r�alis�e avec succ�s !",
                ];
                $this->render('message', $data);
            } else {
                $data = [
                    'title' => "Echec",
                    'message' => "Aucune entr�e correspondante trouv�e pour la suppression.",
                ];
                $this->render('message', $data);
            }

        } else {
            $this->action_error('Il manque des informations pour cette suppression !');
        }
    }

    public function action_default() {
        $this->action_formDelete();
    }
}


?>