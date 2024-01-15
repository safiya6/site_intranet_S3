<?php
 session_start();

class Controller_page extends Controller
{

    
    public function action_default() {
        $this->render("test");
    }
    public function action_utilisateur(){

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
    }

    public function action_secretaire()
    {
        $this->action_utilisateur();
    }

    public function action_chefDept()
    {
        
        $this->action_utilisateur();
        $m = Model::getModel();
        $_SESSION["departement"] = $m->recup_departement($_SESSION["ide"]);
        $_SESSION["HeurediscIUTDept"] = json_encode($m->getHeurediscIUTDept($_SESSION["departement"],$_SESSION["semestre"]));
        $this->action_enseignant(); 
     
       
    }

    public function action_directeur()
    {   $this-> action_utilisateur();
        $m=Model::getModel();
        $this->action_recupSemestre();
        $_SESSION["pourcentage"]= json_encode($m->getPourcentageAgent() );
        $_SESSION["HeurediscIUT"] = json_encode($m->getHeurediscIUT($_SESSION["semestre"]));
        $this->action_enseignant();
     

    }

   public function action_recupSemestre(){
       
        if (!isset($_POST["semestre"])){
            $_SESSION["semestre"] = 1;
        }else{
           $_SESSION["semestre"] = $_POST["semestre"] ;
        } 
    } 
   public function action_rendre(){
        
        if ($_SESSION["role"]== "secrétaire"){
            $this->action_secretaire();
            $this->render("secretaire");
        } 
        elseif ($_SESSION["role"] == "enseignant"){
            $this-> action_enseignant();
            $this->render('enseignant');
        } 
        elseif ($_SESSION["role"]== "directeur" ){
            $this-> action_directeur();
            $this->render("directeur");
        } 
        elseif ($_SESSION["role"]=="chef de departement"){
            $this-> action_chefDept();
            $this -> render("chefdept");
        } 
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
