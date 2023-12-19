<?php

class Controller_Update extends Controller {

    


    public function action_UpdateFilm(){
        $m = Model::getModel();
        $infos = [];
        if(($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idFilm']) && isset($_POST['titre']) && isset($_POST['genre']) && isset($_POST['duree']) && isset($_POST['anneeSortie']) && isset($_POST['realisateur']))){
            $idFilm = $_POST['idFilm'];
            $titre = $_POST['titre'];
            $genre = $_POST['genre'];
            $duree = $_POST['duree'];
            $anneeSortie = $_POST['anneeSortie'];
            $realisateur = $_POST['realisateur'];

            $infos = [
                'idFilm' => $idFilm,
                'titre' => $titre, 
                'genre' => $genre, 
                'duree' => $duree, 
                'anneeSortie' => $anneeSortie, 
                'realisateur' => $realisateur,
            ];

            $m->getUpdateFilm($infos);


        }
       
        $this->render("update",$infos) ;
    }

    
    
    public function action_default(){
       
        $this->action_UpdateFilm();
    }

}



?>