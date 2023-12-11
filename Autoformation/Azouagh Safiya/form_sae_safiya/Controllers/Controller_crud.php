<?php

class Controller_crud extends Controller
{
    public function action_default(){
        
        $this->action_create();

    }
   
  

    public function action_create(){
        if (isset($_POST["titre"]) and isset($_POST["genre"]) 
            and isset($_POST["duree"]) 
            and isset($_POST["anneesortie"]) 
            and isset($_POST["realisateur"]) ) {
        $m = Model::getModel();
        $m-> create($_POST);
      }

        $this->render("form_create", $_POST);
    }
    public function action_delete(){
        if (isset($_POST["id"])){
            $m = Model::getModel();
            $resultat= $m-> delete($_POST["id"]);            
        }
        $this->render("form_delete", $_POST);
    }
    public function action_read(){
        if ($_SERVER['REQUEST_METHOD']=== "POST" and isset($_POST["id"])){
            $m = Model::getModel();
            $id = $_POST["id"];
            $resultat= ["resultat" => $m-> read($id),];    
        }
        else {$resultat= [];}
        $this->render("form_read",$resultat);
    }
    public function action_update(){

        if ($_SERVER['REQUEST_METHOD']=== "POST" and isset($_POST["id"])and isset($_POST["genre"]) 
        and isset($_POST["duree"]) 
        and isset($_POST["anneesortie"]) 
        and isset($_POST["realisateur"]) )
        {
            $m = Model::getModel();
            $id = $_POST["id"];
            $resultat= ["resultat" => $m-> read($_POST),];    
        }
        else {$resultat= [];}
        $this->render("form_update",$resultat);
    }
    public function action_voirtout(){
        $m = Model::getModel();
        $resultat= ["resultat" => $m-> voirtout()];
        $this->render("form_voirtout",$resultat);
    }
 
}
