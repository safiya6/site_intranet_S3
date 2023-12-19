<?php

class Controller_Create extends Controller {

    


    public function action_AjoutFilm(){
        $m = Model::getModel();
        $infos = [];
        if(($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titre']) && isset($_POST['genre']) && isset($_POST['duree']) && isset($_POST['anneeSortie']) && isset($_POST['realisateur']))){
            $titre = $_POST['titre'];
            $genre = $_POST['genre'];
            $duree = $_POST['duree'];
            $anneeSortie = $_POST['anneeSortie'];
            $realisateur = $_POST['realisateur'];

            $infos = [
                'titre' => $titre, 
                'genre' => $genre, 
                'duree' => $duree, 
                'anneeSortie' => $anneeSortie, 
                'realisateur' => $realisateur,
            ];

            $m->getAjoutFilm($infos);


        }
       
        $this->render("informations",$infos) ;
    }

    
    
    public function action_default(){
       
        $this->action_AjoutFilm();
    }

}



?>