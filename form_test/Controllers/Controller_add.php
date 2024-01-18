<?php

class Controller_add extends Controller {

    public function action_formAdd() {
        $m = Model::getModel();
        $data = [
            "disciplines"  => $m->getDisciplines(),
            "categories" => $m->getCategories(),
            "annees"        => $m->getAnnees(),
        ];
        $this->render("formAddEnseignant", $data);
    }

    public function action_addEnseignant() {
        if (isset($_POST['nom']) AND ! preg_match("/^ *$/", $_POST["nom"]) AND
            isset($_POST['prenom']) AND ! preg_match("/^ *$/", $_POST["prenom"]) AND
            isset($_POST['email']) AND ! preg_match("/^ *$/", $_POST["email"])
        ) {
            $infos = [];
            $noms = ['nom', 'prenom', 'email', 'id_discipline', 'id_categorie', 'scr', 'aa'];
            foreach ($noms as $v) {
                if (isset($_POST[$v]) and ! preg_match("/^ *$/", $_POST[$v])) {
                    $infos[$v] = $_POST[$v];
                } else {
                    $infos[$v] = null;
                }
            }

            $m = Model::getModel();
            $add = $m->addEnseignant($infos);
            if ($add) {
                $data = [
                    'title' => "Réussi",
                    'message' => "L'ajout a été réussi avec succès !",
                ];
                $this->render('message', $data);
            }

            else {
                $data = [
                    'title' => "Echec",
                    'message' => "L'ajout n'a pas pu être ajouté, réésayez !",
                ];
                $this->render('message', $data);
            }

        }

        else {
            $this->action_error('Il manque des informations pour cet ajout !');
        }
    }

    public function action_default() {
        $this->action_formAdd();
    }

}

?>