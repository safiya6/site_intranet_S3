<?php
 session_start();

class Controller_page extends Controller
{
    public function action_default() {
        $this->render("test");
    }
    public function action_utilisateur(){

        $m = Model::getModel();
        $SC= $m->getServiceStatutairevsComplémentaire($_SESSION["semestre"]);
        $_SESSION["S_vs_C"]=json_encode($SC);
        

    } 
    
    public function action_enseignant()
    {
        $m = Model::getModel();
        $list = $m->getQuotite(((int)$_SESSION["ide"]));
        $_SESSION["heureens"] = json_encode($m->gethorairestravail($_SESSION["ide"] ,$_SESSION["semestre"]));
        $monTableauJSON = json_encode($list);   
        $_SESSION["quotite"]  = $monTableauJSON ;
        $this-> render("page_identifiant");
    }

    public function action_secretaire()
    {
        $m = Model::getModel();
        $_SESSION["departement"]= $m->get_departementSecretaire($_SESSION["ide"]);
        $this->action_utilisateur();
        $_SESSION["enseigneDept"] = json_encode($m->getEnseignantparDept($_SESSION["departement"]));
        $_SESSION["HeurediscIUTDept"] = json_encode($m->getHeurediscIUTDept($_SESSION["departement"],$_SESSION["semestre"],$_SESSION["niveau"]));
        $this-> render("page_identifiant");
    }

    public function action_chefDept()
    {
        
        $this->action_utilisateur();
        $m = Model::getModel();
        $_SESSION["departement"] = $m->recup_departement($_SESSION["ide"]);
        $_SESSION["enseigneDept"] = json_encode($m->getEnseignantparDept($_SESSION["departement"]));
        $_SESSION["HeurediscIUTDept"] = json_encode($m->getHeurediscIUTDept($_SESSION["departement"],$_SESSION["semestre"],$_SESSION["niveau"]));
        $this->action_enseignant(); 
        $this-> render("page_identifiant");
     
       
    }


    public function action_directeur()
    {   $this-> action_utilisateur();
        $m=Model::getModel();
        $_SESSION["pourcentage"]= json_encode($m->getPourcentageAgent() );
        $_SESSION["HeurediscIUT"] = json_encode($m->getHeurediscIUT($_SESSION["semestre"],$_SESSION["niveau"] ));
        $this->action_enseignant();
        $this-> render("page_identifiant");

    }

   public function action_recupSemestre(){
       
        if (!isset($_POST["semestre"] )&!isset($_POST["niveau"])){
            $_SESSION["semestre"] = 1;
        }else{
           $_SESSION["semestre"] = $_POST["semestre"] ;
        } 
        if($_SESSION["role"]== "directeur") {
            $this-> action_directeur();
        }
        elseif ($_SESSION["role"] == "chef de departement"){
            $this-> action_chefDept();
        }elseif($_SESSION["role"]=="secretaire"){
            $this-> action_secretaire();
        } 
        elseif($_SESSION["role"] == "enseignant"){
            $this-> action_enseigant();
        }
        else {
            $this-> action_directeur();
        } 
    } 
    public function action_recupNiveau(){
       
        if (!isset($_POST["niveau"])){
            $_SESSION["niveau"] = 1;
            
        }else{
           $_SESSION["niveau"]=$_POST["niveau"];
           
        } 
        if($_SESSION["role"]== "directeur") {
            $this-> action_directeur();
        }
        elseif ($_SESSION["role"] == "chef de departement"){
            $this-> action_chefDept();
        }elseif($_SESSION["role"]=="secretaire"){
            $this-> action_secretaire();
        } 
        elseif($_SESSION["role"] == "enseignant"){
            $this-> action_enseigant();
        }
        else {
            $this-> action_directeur();
        } 
    } 
   /*public function action_rendre(){
        
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
   } */

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
