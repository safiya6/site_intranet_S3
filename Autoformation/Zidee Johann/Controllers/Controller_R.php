<?php

class Controller_R extends Controller {


    public function action_allFilms(){
        
        $m = Model::getModel();
        $d = ["liste" => $m->getFilms()];
        $this->render("liste", $d) ;

    }

    public function action_default(){
       
        $this->action_allFilms();
    }


}

?>