<?php

class Controller_add extends Controller {

    // affiche le formulaire d'ajout d'enseignant avec les données nécessaires
    public function action_formAddEnseignant() {
        $m = Model::getModel();
        $data = [
            "disciplines" => $m->getDisciplines(),
            "categories"  => $m->getCategories(),
            "annees"      => $m->getAnnees(),
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
            }
             // Si des informations essentielles manquent dans les données POST ou qu il est vide cela affiche cette erreur
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

    
    public function action_formAddCours() {
        $m = Model::getModel();
        $disciplines = $m->disciplineBesoinHeure();
        if (count($disciplines) > 0) {
            $data = [
                'disciplines' => $disciplines,
                'niveaux'     => [1 => "BUT 1", 2 => "BUT 2", 3 => "BUT 3", 4 => "Licence 3"]
            ];
            $this->render('formAddCours', $data);
        }
        else {
            $data = [
                'title' => "Echec",
                'message' => "Il n'y a aucun besoin en heure !",
            ];
            $this->render('message', $data);
        }
    }

    public function action_formChoiceEnseignant() {
        $m = Model::getModel();
        $disciplines = $m->disciplineBesoinHeure();
        $data = ['enseignants' => $m->getEnseignantDispoHeure($disciplines[e($_POST['ligne'])]),
                 'besoinHeure' => $disciplines[e($_POST['ligne'])]['besoin_heure'],
                 'discipline'  => e($_POST['ligne'])];
        $this->render('addCours', $data);
    }

    public function action_addCours() {
        $m = Model::getModel();
        $disciplines = $m->disciplineBesoinHeure();
        $discipline  = $disciplines[e($_POST['discipline'])];
        $enseignants = $m->getEnseignantDispoHeure($discipline);
        foreach($enseignants as $ligne) {
            if ($ligne['id_personne'] == e($_POST['id_personne'])){
                $enseignant = $ligne;
                break;
            }
        }
        if (e($_POST['nbHeure']) > $enseignant['nbHeure']) {
            $data = [
                'title' => "Trop d'heure",
                'message' => "Il y a trop d'heures pour cet(te) enseignant(e) !",
            ];
            $this->render('message', $data);
        }
        else {
            $infos = ["id_personne"   => e($_POST['id_personne']),
                      "id_discipline" => $discipline['id_discipline'],
                      "aa"            => $discipline['aa'],
                      "s"             => $discipline['s'],
                      "nbHeure"       => e($_POST['nbHeure']),
                      "id_formation"  => $discipline['id_formation'],
                      "id_departement" => $discipline['id_departement'],
                      "besoin_heure"   => $discipline['besoin_heure']- e($_POST['nbHeure'])];
            if ($infos['besoin_heure'] == 0) {
                $rst = ($m->addEnseigne($infos) && $m->delBesoinHeure($infos));
            }
            else {
                $rst = ($m->addEnseigne($infos) && $m->updateBesoinHeure($infos));
            }
            if ($rst) {
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
    }

    // Action par défaut, redirige vers le formulaire d ajout
    public function action_default() {
        $this->action_formAddEnseignant();
    }

}

?>
