<?php 
Class Controller_connection extends Controller{
    
    public function action_seConnecter(){
      
        $m = Model::getModel();
        
        $mdp =(string)$_POST['password'];
        $this -> render("connection");

    
    } 
    public function action_ajouterUser(){
        $m = Model::getModel();
        
    }

    
    public function action_default()
    {
        $this-> action_seConnecter();
    
    }
}

?>