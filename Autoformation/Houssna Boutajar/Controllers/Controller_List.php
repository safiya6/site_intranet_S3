<?php

require_once 'controller.php';  
require_once 'Model/model.php';      

class Controller_List extends Controller {

    public function action_default() {
        $this->action_listerFilms(); 
    }
    
   // Dans Controller_List.php
public function action_ajouter() {
    $m = Model::getModel();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $infos = [
            'titre' => $_POST['Titre'],
            'anneesortie' => $_POST['AnneeSortie'],
            'duree' => $_POST['Duree'],
            'realisateur' => $_POST['Realisateur'],
            'genre' => $_POST['Genre'],
            'idfilm' => $_POST['idfilm']
        ];
        $m->ajouterFilm($infos);

       
        header("Location: ?controller=list&action=listerFilms");
        exit;
    } else {
        
        $this->render("ajouter", []);
    }
}


    public function action_modifier() {
        $m = Model::getModel();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idFilm = $_POST['idfilm'] ?? null;
    
            if (isset($_POST['Titre'])) {
              
                $m->modifierFilm($_POST);
                header("Location: ?controller=list&action=listerFilms");
                exit;
            } elseif ($idFilm) {
              
                $film = $m->getFilm($idFilm);
                $this->render("modifier", ['film' => $film]);
            }
        } else {
          
            $this->render("modifier", []);
        }
    }
    

    public function action_listerFilms() {
        $m = Model::getModel();
        $films = $m->ListerFilms(); 
        $this->render("lister", ['films' => $films]);
    }
    
    public function action_supprimer() {
        $m = Model::getModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['nomFilm'])) {
                $m->supprimerFilmParNom($_POST['nomFilm']);
                header("Location: ?controller=list&action=listerFilms");
                exit;
            }
        } else {
          
            $this->render("supprimer", []);
        }
    }

}
