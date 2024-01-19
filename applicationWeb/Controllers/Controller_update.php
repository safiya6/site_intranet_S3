<?php

class Controller_update extends Controller {

    public function action_formUpdateBesoinHeure() {
        $m = Model::getModel();
        $data = [
            "annees"       => $m->getAnnees(),
            "semestres"    => $m->getSemestres(),
            "niveaux"      => [1 => "BUT 1", 2 => "BUT 2", 3 => "BUT 3", 4 => "Licence 1", 5 => "Licence 2", 6 => "Licence 3"],
            "formations"   => $m->getFormations(),
            "disciplines"  => $m->getDisciplines(),
            "departements" => $m->getDepartements()
        ];
        $this->render("formUpdateBesoinHeure", $data);        
    }

    public function action_choiceUpdateBesoinHeure() {
        $infos = [
            "aa"             => $_POST["aa"],
            "s"              => $_POST["s"],
            "id_formation"   => $_POST["id_formation"],
            "id_discipline"  => $_POST["id_discipline"],
            "id_departement" => $_POST["id_departement"]
        ];
        $m = Model::getModel();
        $besoin = $m->getBesoinHeure($infos);
        if ($besoin != null) {
            $infos['ancienBesoinHeure'] = $besoin;
            $this->render("choiceUpdateBesoinHeure", $infos);
        }
        else {
            $data = [
                'title' => "Echec",
                'message' => "Le besoin en heure n'existe pas, merci de le creer",
            ];
            $this->render('message', $data);
        }
    }

    public function action_updateBesoinHeure() {
        if (isset($_POST['besoin_heure']) and ! preg_match("/^ *$/", $_POST["besoin_heure"])) {
            $infos = [
                "besoin_heure"   => $_POST["besoin_heure"],
                "aa"             => $_POST["aa"],
                "s"              => $_POST["s"],
                "id_formation"   => $_POST["id_formation"],
                "id_discipline"  => $_POST["id_discipline"],
                "id_departement" => $_POST["id_departement"]
            ];
            $m = Model::getModel();
            $update = $m->updateBesoinHeure($infos);
            if($update) {
                $data = [
                    'title' => "Réussi",
                    'message' => "Le besoin en heure a été changé avec succès !",
                ];
                $this->render('message', $data);
            }
            else {
                $data = [
                    'title' => "Echec",
                    'message' => "Le changement de besoin en heure n'a pas pu être effectué, réésayez !",
                ];
                $this->render('message', $data);
            }
        }

        else {
            $this->action_error('Le nouveau besoin en heure n\'a pas été compris, réésayez !');
        }

    }

    public function action_default() {
        $this->action_formUpdateBesoinHeure();
    }

}

?>