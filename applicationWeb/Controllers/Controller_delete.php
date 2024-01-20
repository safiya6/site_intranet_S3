<?php

class Controller_delete extends Controller {

    // Action pour afficher le formulaire de suppression d'enseignant
    public function action_formDelete() {
        $m = Model::getModel();
        $data = [
            "personnes"  => $m->getPersonnes(),
        ];
        $this->render("formDeleteEnseignant", $data);
    }

    // Action pour supprimer un enseignant en fonction du POST
    public function action_deleteEnseignant() {
        if (!empty(e($_POST['id_personne']))) {
            $infos = e($_POST['id_personne']);

            $m = Model::getModel();

            // Suppression de l'enseignant
            $deleteEnseignant = $m->deleteEnseignantEtPersonne($infos);

            // Affichage du message de réussite ou d'échec en fonction de la suppression
            if ($deleteEnseignant != false) {
                $data = [
                    'title' => "Réussi",
                    'message' => "La suppression a été réalisée avec succès !",
                ];
                $this->render('message', $data);
            } else {
                $data = [
                    'title' => "Echec",
                    'message' => "Aucune entrée correspondante trouvée pour la suppression.",
                ];
                $this->render('message', $data);
            }
        } else {
            $this->action_error('Il manque des informations pour cette suppression !');
        }
    }

    // Action par défaut, redirige vers le formulaire de suppression
    public function action_default() {
        $this->action_formDelete();
    }
}

?>
