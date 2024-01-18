<?php
require './Utils/keys.php';
require_once './Utils/RSAmodule.php';

$privKey = PRIVATE_KEY;
$pubKey = PUBLIC_KEY;
class Controller_RSA extends Controller
{
    public function action_chiffrerBDD(){
        global $pubKey;
        // Traitement des actions de l'utilisateur
        $m = Model::getModel();
        $etat=0;
        $bdd=0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'chiffrer') {
        $tab= $m->recuperer_id();
        $taille=verifMdp($tab);
        $resultat = $m->chiffrerToutMdp($taille,$tab,$pubKey);
        $etat= $m->isChiffre();

        if($resultat===1){
            $bdd="succes";
        }
        else{
            $bdd="skipped";
        }
        $data=["etat" => $etat,"bdd"=>$bdd];
        $this->render("RSA",$data);
    }



    $data=["etat" => $etat,"bdd"=>$bdd];
    $this->render("RSA",$data);

    }
 
 public function action_dechiffrerBDD(){
    global $privKey;
    // Traitement des actions de l'utilisateur
    $m = Model::getModel();
    $etat=0;
    $bdd=0;
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'dechiffrer') {

    $tab= $m->recuperer_id();
    $taille=verifMdp($tab);
    $resultat = $m->dechiffrerToutMdp($taille,$tab,$privKey);
    $etat=$m->isChiffre();
    if($resultat===1){
        $bdd="succes";
    }
    else{
        $bdd="skipped";
    }


  
    }
    $data=["etat" => $etat,"bdd"=>$bdd];
    $this->render("RSA",$data);

}


    
public function action_default() {

        $this->render("RSA");
    }
}





?>