<?php


class Controller_page extends Controller
{
    public function action_default() {
        $this->action_donneEnseignant();
    }

    public function action_donneEnseignant() {
        session_start();
        $m = Model::getModel();
        if ($m->est_enseignant($_SESSION["ide"])){
            $list = $m->getQuotite(((int)$_SESSION["ide"]));
    
            $monTableauJSON = json_encode($list);
           
            $_SESSION["quotite"]  = $monTableauJSON ;
        }  
          
        $this->render("page_identifiant");
  
    } 
}
?>
