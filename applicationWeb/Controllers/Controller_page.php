<?php
// Démarre la session 
session_start();

class Controller_page extends Controller
{
    // Action par défaut qui affiche la page de test
    public function action_default() {
        $this->render("test");
    }

    // Action pour récupérer les informations d'un utilisateur
    public function action_utilisateur(){
        $m = Model::getModel();
        // Récupère le service statutaire vs complémentaire pour le semestre en cours
        $SC = $m->getServiceStatutairevsComplémentaire($_SESSION["semestre"]);
        $_SESSION["S_vs_C"] = json_encode($SC);
    } 
    
    // Action pour un enseignant
    public function action_enseignant()
    {
        $m = Model::getModel();
        // Récupère la quotité de l'enseignant
        $list = $m->getQuotite((int)$_SESSION["ide"]);
        $_SESSION["heureens"] = json_encode($m->gethorairestravail($_SESSION["ide"], $_SESSION["semestre"]));
        $monTableauJSON = json_encode($list);   
        $_SESSION["quotite"]  = $monTableauJSON ;
        $this->render("page_identifiant");
    }

    // Action pour un secrétaire
    public function action_secretaire()
    {
        $m = Model::getModel();
        $_SESSION["departement"] = $m->get_departementSecretaire($_SESSION["ide"]);
        $this->action_utilisateur();
        $_SESSION["enseigneDept"] = json_encode($m->getEnseignantparDept($_SESSION["departement"]));
        $_SESSION["HeurediscIUTDept"] = json_encode($m->getHeurediscIUTDept($_SESSION["departement"], $_SESSION["semestre"], $_SESSION["niveau"]));
        $this->render("page_identifiant");
    }

    // Action pour un chef de département
    public function action_chefDept()
    {
        $this->action_utilisateur();
        $m = Model::getModel();
        $_SESSION["departement"] = $m->recup_departement($_SESSION["ide"]);
        $_SESSION["enseigneDept"] = json_encode($m->getEnseignantparDept($_SESSION["departement"]));
        $_SESSION["HeurediscIUTDept"] = json_encode($m->getHeurediscIUTDept($_SESSION["departement"], $_SESSION["semestre"], $_SESSION["niveau"]));
        $this->action_enseignant(); 
        $this->render("page_identifiant");
    }

    // Action pour un directeur
    public function action_directeur()
    {   
        $this->action_utilisateur();
        $m=Model::getModel();
        $_SESSION["pourcentage"]= json_encode($m->getPourcentageAgent() );
        $_SESSION["HeurediscIUT"] = json_encode($m->getHeurediscIUT($_SESSION["semestre"], $_SESSION["niveau"] ));
        $this->action_enseignant();
        $this->render("page_identifiant");
    }

    // Action pour récupérer le semestre sélectionné
    public function action_recupSemestre(){
        if (!isset($_POST["semestre"]) && !isset($_POST["niveau"])){
            $_SESSION["semestre"] = 1;
        } else {
           $_SESSION["semestre"] = $_POST["semestre"] ;
        } 
        // Redirection en fonction du rôle de l'utilisateur
        if ($_SESSION["role"] == "directeur") {
            $this->action_directeur();
        } elseif ($_SESSION["role"] == "chef de departement") {
            $this->action_chefDept();
        } elseif ($_SESSION["role"] == "secretaire") {
            $this->action_secretaire();
        } elseif ($_SESSION["role"] == "enseignant") {
            $this->action_enseignant();
        } else {
            $this->action_directeur();
        } 
    } 

    // Action pour récupérer le niveau sélectionné
    public function action_recupNiveau(){
        if (!isset($_POST["niveau"])){
            $_SESSION["niveau"] = 1;
        } else {
           $_SESSION["niveau"] = $_POST["niveau"];
        } 
        // Redirection en fonction du rôle de l'utilisateur
        if ($_SESSION["role"] == "directeur") {
            $this->action_directeur();
        } elseif ($_SESSION["role"] == "chef de departement") {
            $this->action_chefDept();
        } elseif ($_SESSION["role"] == "secretaire") {
            $this->action_secretaire();
        } elseif ($_SESSION["role"] == "enseignant") {
            $this->action_enseignant();
        } else {
            $this->action_directeur();
        } 
    }
} 

   
