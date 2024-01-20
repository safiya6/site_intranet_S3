<?php

class Controller_add extends Controller {

    // affiche le formulaire d'ajout d'enseignant avec les données nécessaires
    public function action_formAdd() {
        $m = Model::getModel();
        $data = [
            "disciplines"  => $m->getDisciplines(),
            "categories" => $m->getCategories(),
            "annees"        => $m->getAnnees(),
        ];
        $this->render("formAddEnseignant", $data);
    }

    //  ajoute un enseignant en fonction des données reçues dans le POST
    public function action_addEnseignant() {
        // Vérification de la présence des informations nécessaires dans POST
        if (e(isset($_POST['nom'])) AND ! preg_match("/^ *$/", e($_POST["nom"])) AND
            e(isset($_POST['prenom'])) AND ! preg_match("/^ *$/", e($_POST["prenom"])) AND
            e(isset($_POST['email'])) AND ! preg_match("/^ *$/", e($_POST["email"]))
        ) {
            $infos = [];
            $noms = ['nom', 'prenom', 'email', 'id_discipline', 'id_categorie', 'aa'];

            foreach ($noms as $v) {
                if (e(isset($_POST[$v])) and ! preg_match("/^ *$/", e($_POST[$v]))) {
                    $infos[$v] = e($_POST[$v]);
                } else {
                    $infos[$v] = null;
                }
            }

            // Accès au modèle + ajout de l enseignant
            $m = Model::getModel();
            $add = $m->addEnseignant($infos);

            // Affichage du message de réussite ou d'échec en fonction du résultat de l ajout
            if ($add) {
                $data = [
                    'title' => "Réussi",
                    'message' => "L'ajout a été réussi avec succès !",
                ];
                $this->render('message', $data);
            } else {
                $data = [
                    'title' => "Echec",
                    'message' => "L'ajout n'a pas pu être ajouté, réessayez !",
                ];
                $this->render('message', $data);
            }
        }

        // Si des informations essentielles manquent dans les données POST ou qu il est vide cela affiche cette erreur
        else {
            $this->action_error('Il manque des informations pour cet ajout !');
        }
    }

    // Action par défaut, redirige vers le formulaire d ajout
    public function action_default() {
        $this->action_formAdd();
    }

}

?>
