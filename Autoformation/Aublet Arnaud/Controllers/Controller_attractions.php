<?php

class Controller_attractions extends Controller
{
    public function action_form_attrac()
    {
        $data = [];
        $this->render("form_attrac", $data);
    }

    public function action_default()
    {
        $this->action_form_attrac();
    }

    public function action_attraction()
    {
        if(isset($_GET["taille"])){
            if($_GET['taille'] > 0){
                $m = Model::getModel();
                $data = ["attractions" => $m->getAttractions($_GET['taille'])];
                $this->render("attraction", $data);
            }
            else {
                $this->action_error("Une taille ne peut être négative !");
            }
        }
    }
}