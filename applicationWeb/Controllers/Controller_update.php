<?php

class Controller_update extends Controller {

    // Action pour afficher le formulaire de mise à jour du besoin en heure avec les données nécessaires
    public function action_formUpdateBesoinHeure() {
        $m = Model::getModel();
        $data = [
            "annees"       => $m->getAnnees(),
            "semestres"    => $m->getSemestres(),
            "niveaux"      => [1 => "BUT 1", 2 => "BUT 2", 3 => "BUT 3", 4 => "Licence 3"],
            "formations"   => $m->getFormations(),
            "disciplines"  => $m->getDisciplines(),
            "departements" => $m->getDepartements()
        ];
        $this->render("formUpdateBesoinHeure", $data);        
    }

    // Action pour choisir le besoin en heure à mettre à jour
    public function action_choiceUpdateBesoinHeure() {
        $infos = [
            "aa"             => e($_POST["aa"]),
            "s"              => e($_POST["s"]),
            "id_formation"   => e($_POST["id_formation"]),
            "id_discipline"  => e($_POST["id_discipline"]),
            "id_departement" => e($_POST["id_departement"])
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
                'message' => "Le besoin en heure n'existe pas, merci de le créer",
            ];
            $this->render('message', $data);
        }
    }

    // Action pour effectuer la mise à jour du besoin en heure
    public function action_updateBesoinHeure() {
        // Vérification de la présence et de la validité des données POST
        if (e(isset($_POST['besoin_heure'])) and ! preg_match("/^ *$/", e($_POST["besoin_heure"]))) {
            $infos = [
                "besoin_heure"   => e($_POST["besoin_heure"]),
                "aa"             => e($_POST["aa"]),
                "s"              => e($_POST["s"]),
                "id_formation"   => e($_POST["id_formation"]),
                "id_discipline"  => e($_POST["id_discipline"]),
                "id_departement" => e($_POST["id_departement"])
            ];
            $m = Model::getModel();
            $update = $m->updateBesoinHeure($infos);
            // Affichage du message de réussite ou d'échec en fonction du résultat de la mise à jour
            if ($update) {
                $data = [
                    'title' => "Réussi",
                    'message' => "Le besoin en heure a été changé avec succès !",
                ];
                $this->render('message', $data);
            }
            else {
                $data = [
                    'title' => "Echec",
                    'message' => "Le changement de besoin en heure n'a pas pu être effectué, réessayez !",
                ];
                $this->render('message', $data);
            }
        }

        else {
            $this->action_error('Le nouveau besoin en heure n\'a pas été compris, réessayez !');
        }
    }

    // Action par défaut, redirige vers le formulaire de mise à jour du besoin en heure
    public function action_default() {
        $this->action_formUpdateBesoinHeure();
    }

}

?>
