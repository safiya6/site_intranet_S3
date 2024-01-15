<?php

require_once "./Utils/RSAmodule.php";
require_once "./Utils/keys.php";
class Model
{
    
    private $bd;

    private static $instance = null;

    private function __construct()
    {
        include "credentials.php";
        $this->bd = new PDO($dsn, $login, $mdp);
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->bd->query("SET nameS 'utf8'");
    }

    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    
//soheib et tom #RSA
    public function recuperer_id(){
        $requete = $this->bd->prepare('SELECT * FROM identifiant');
        $requete -> execute();
        return $requete->fetchall();
    }

function chiffrerToutMdp($taille,$tab,$pubKey){
    if($taille!=344){
        foreach($tab as $row){
            $id = $row[0];
            $mdp = $row[1];
            $mdpRSA=encryptRSA($mdp,$pubKey);
            $req=$this->bd->prepare("UPDATE identifiant SET mdp='".$mdpRSA."' WHERE ide='".$id."'");
            
            $req->execute();
        }
        return 1;
    }
    else{
        return 0;
    }
}

function dechiffrerToutMdp($taille,$tab,$privKey){
    if($taille==344){
      
        foreach($tab as $row){
            $id = $row[0];
            $mdp = $row[1];
            $mdpRSA=decryptRSA($mdp,$privKey);
            $req= $this->bd->prepare("UPDATE identifiant SET mdp='".$mdpRSA."' WHERE ide='".$id."'");
            $req->execute();
        }
        return 1;
    }
    else{
        return 0;
    }
}

function isChiffre(){
    $requete = $this->bd->prepare('SELECT * FROM identifiant');
    $requete -> execute();
    $tab = $requete->fetchall();

    foreach($tab as $row){
        $id = $row[0];
        $mdp = $row[1];
        $nb344=0;
        $nbTot=0;
        if(strlen($mdp) == 344){
            $nb344++;
            $nbTot++;
        }
        else{
            $nbTot++;
        }
    }
    if($nb344==$nbTot){
        return 1;
    }
    else{
        return 0;
    }
     
}





    //fin de RSA




    public function recuperer_donnee($id){
        $requete = $this->bd->prepare('SELECT * from personne where id_personne = :id ');
        $requete->bindValue(':id', $id);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }








    public function est_connecte($id, $mdp) {
        $privKey = PRIVATE_KEY;

        $requete = $this->bd->prepare('SELECT mdp from identifiant where ide = :id ');
        $requete->bindValue(':id', $id);
        $requete->execute();
        $data = $requete->fetch(PDO::FETCH_ASSOC);
        var_dump($data);
        $mdpRSADechiffre =decryptRSA($data["mdp"], $privKey);
        var_dump($mdpRSADechiffre);

        if($mdpRSADechiffre==$mdp){return True;}
        else{return False;}
    }









    public function est_enseignant($id)
    {
        $requete = $this->bd->prepare('SELECT * from enseignant where enseignant.id_personne = :id');
        $requete->bindValue(':id', $id);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat !== false;

    }

    public function est_secretaire($id)
    {
        $requete = $this->bd->prepare('SELECT * from  secretaire where secretaire.id_personne = :id');
        $requete->bindValue(':id', $id);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat !== false;

    }
    public function est_chefdepartement($id){
        $requete = $this->bd->prepare('SELECT * from  departement where departement.id_personne = :id ');
        $requete->bindValue(':id', $id);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat !== false;
    } 
    public function recup_departement($id){
        $requete = $this->bd->prepare('SELECT sigleDept from  departement where departement.id_personne = :id ');
        $requete->bindValue(':id', $id);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        $dept = $resultat["sigledept"]; 
        return $dept;
    } 
    public function est_directeur($id)
    {
        $requete = $this->bd->prepare('SELECT * from  directeur where directeur.id_personne = :id ');
        $requete->bindValue(':id', $id);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat !== false;
        
    }


 
    public function getQuotite($id)
{ 
    $requete = $this->bd->prepare('SELECT quotite, sigleDept FROM assigner JOIN departement ON departement.id_departement = assigner.id_departement WHERE assigner.id_personne = :id;');
    $requete->bindValue(':id', $id);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

    $quotites = [];
    foreach ($resultat as $values) {
        // Création d'un tableau associatif avec les clés 'quotite' et 'dept'
        $quotites[] = [
            'label' => $values['sigledept'],
            'data' => (float)$values['quotite']
        ];
    }
  
    return $quotites;
}
public function getServiceStatutairevsComplémentaire(){
        $requete = $this->bd->prepare('SELECT discipline.libelleDisc as label,SUM(categorie.serviceStatutaire) AS data1,SUM(categorie.serviceComplementaireEnseignement) AS data2 FROM enseignant JOIN 
        enseigne ON enseignant.id_personne = enseigne.id_personne JOIN discipline ON discipline.id_discipline = enseigne.id_discipline JOIN categorie ON categorie.id_categorie = enseignant.id_categorie GROUP BY discipline.id_discipline, discipline.libelleDisc;');
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;



}
public function getPourcentageAgent(){
    $requete = $this->bd->prepare('SELECT  c.siglecat as label,
    CASE
        WHEN COUNT(e.id_personne) > 0
        THEN ROUND((COUNT(e.id_personne) * 100.0 / (SELECT COUNT(*) FROM enseignant)), 2)
        ELSE 0
    END AS "data"
FROM
    categorie c
LEFT JOIN
    enseignant e ON c.id_categorie = e.id_categorie
GROUP BY
    c.siglecat;');
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}  
public function getHeurediscIUT($s){
    $requete =  $this->bd->prepare(' SELECT sum(nbheureens) as data1, libelledisc as label, sigleDept as data2 from discipline join enseigne on discipline.id_discipline = enseigne.id_discipline join assigner on assigner.id_personne = enseigne.id_personne join departement on assigner.id_departement = departement.id_departement where enseigne.S = :s group by libelledisc, sigledept;');
    $requete->bindValue(':s',$s);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
} 
public function getHeurediscIUTDept($id,$s){
    $requete =  $this->bd->prepare(' SELECT sum(nbheureens) as data1, libelledisc as label, sigleDept as data2 from discipline join enseigne on discipline.id_discipline = enseigne.id_discipline join assigner on assigner.id_personne = enseigne.id_personne join departement on assigner.id_departement = departement.id_departement where sigledept= :id and enseigne.S = :s group by libelledisc, sigledept;');
    $requete->bindValue(':id', $id);
    $requete->bindValue(':s', $s);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}
}