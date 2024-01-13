<?php


class Controller_page extends Controller
{
    public function action_default() {
        $this->render("test");
    }
    public function action_utilisateur(){
        session_start();
        $m = Model::getModel();
        $SC= $m->getServiceStatutairevsComplémentaire();
        $_SESSION["S_vs_C"]=json_encode($SC);

    } 
    
    public function action_enseignant()
    {
        $m = Model::getModel();
         
        $list = $m->getQuotite(((int)$_SESSION["ide"]));
        $monTableauJSON = json_encode($list);   
        $_SESSION["quotite"]  = $monTableauJSON ; 
        $this->render("page_identifiant");
    }

    public function action_secretaire()
    {
        $this->action_utilisateur();
        $this->render("page_identifiant");
    }

    public function action_chefDept()
    {
        
        $this->action_utilisateur();
        $m = Model::getModel();
        $_SESSION["departement"] = $m->recup_departement($_SESSION["ide"]);
        $this->action_enseignant(); 
        $this->render("page_identifiant");
    }

    public function action_directeur()
    {   $this-> action_utilisateur();
        $m=Model::getModel();
        $_SESSION["pourcentage"]= json_encode($m->getPourcentageAgent() );
        $this->action_enseignant();
        $this->render("page_identifiant");
    }

    /**public function action_donneEnseignant() {
        session_start();
        $m = Model::getModel();
        if ($m->est_enseignant($_SESSION["ide"])){
            $list = $m->getQuotite(((int)$_SESSION["ide"]));
    
            $monTableauJSON = json_encode($list);
           
            $_SESSION["quotite"]  = $monTableauJSON ;
        }  
          
        $this->render("page_identifiant");
  
    } */
}
?>
