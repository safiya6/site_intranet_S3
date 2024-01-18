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



    public function getDisciplines() {
        $requete = $this->bd->prepare('SELECT * FROM discipline');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategories() {
        $requete = $this->bd->prepare('SELECT * FROM categorie');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAnnees() {
        $requete = $this->bd->prepare('SELECT * FROM annee');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFormations() {
        $requete = $this->bd->prepare('SELECT * FROM formation');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDepartements() {
        $requete = $this->bd->prepare('SELECT * FROM departement');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSemestres() {
        $requete = $this->bd->prepare('SELECT * FROM semestre');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPersonne($infos) {
        $requete = $this->bd->prepare('INSERT INTO personne (nom, prenom, email) VALUES (:nom, :prenom, :email)');
        $marqueurs = ['nom', 'prenom', 'email'];
        foreach ($marqueurs as $value) {
            $requete->bindValue(':' . $value, $infos[$value]);
        }
        $requete->execute();
        return (bool) $requete->rowCount(); 
    }

    public function findIdPersonne($infos) {
        $requete = $this->bd->prepare('SELECT id_personne FROM personne WHERE nom = :nom AND prenom = :prenom AND email = :email');
        $marqueurs = ['nom', 'prenom', 'email'];
        foreach ($marqueurs as $value) {
            $requete->bindValue(':' . $value, $infos[$value]);
        }
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC)["id_personne"];
    }

    public function addEnseignant($infos) {
        $this->addPersonne($infos);
        $id_personne = $this->findIdPersonne($infos);
        $requete = $this->bd->prepare('INSERT INTO enseignant VALUES (:id_personne, :id_discipline, :id_categorie, :aa)');
        $marqueurs = ['id_discipline', 'id_categorie', 'aa'];
        foreach ($marqueurs as $value) {
            $requete->bindValue(':' . $value, $infos[$value]);
        }
        $requete->bindValue(':id_personne', $id_personne);
        $requete->execute();
        return (bool) $requete->rowCount();
    }

    public function getBesoinHeure($infos) {
        $requete = $this->bd->prepare('SELECT besoin_heure FROM besoin WHERE AA = :aa AND S = :s AND id_formation = :id_formation AND id_discipline = :id_discipline AND id_departement = :id_departement');
        $marqueurs = ['aa', 's', 'id_formation', 'id_discipline', 'id_departement'];
        foreach ($marqueurs as $value) {
            $requete->bindValue(':' . $value, $infos[$value]);
        }
        $requete->execute();
        $rst = $requete->fetch(PDO::FETCH_ASSOC);
        if ($rst) {
            return $rst["besoin_heure"];
        }
        return null;
    }

    public function updateBesoinHeure($infos) {
        $requete = $this->bd->prepare('UPDATE besoin SET besoin_heure = :besoin_heure WHERE AA = :aa AND S = :s AND id_formation = :id_formation AND id_discipline = :id_discipline AND id_departement = :id_departement');
        $marqueurs = ['besoin_heure', 'aa', 's', 'id_formation', 'id_discipline', 'id_departement'];
        foreach ($marqueurs as $value) {
            $requete->bindValue(':' . $value, $infos[$value]);
        }
        $requete->execute();
        return (bool) $requete->rowCount();
    }


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
    public function get_departementSecretaire($id){
        $requete = $this->bd->prepare('select sigleDept from departement join assigner on departement.id_departement= assigner.id_departement where assigner.id_personne = :id;');
        $requete->bindValue(':id', $id);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        $dept = $resultat["sigledept"]; 
        return $dept;
    }
    public function est_chefdepartement($id){
        $requete = $this->bd->prepare('SELECT * from  departement where departement.id_personne = :id ');
        $requete->bindValue(':id', $id);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat !== false;
    } 
    public function est_equipedirection($id){
        $requete = $this->bd->prepare('SELECT * from  equipedirection where equipedirection.id_personne = :id ');
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
public function getServiceStatutairevsComplémentaire($s){
    $requete = $this->bd->prepare('SELECT discipline.libelleDisc as label,SUM(categorie.serviceStatutaire) AS datax,SUM(categorie.serviceComplementaireEnseignement) AS datay FROM enseignant JOIN 
    enseigne ON enseignant.id_personne = enseigne.id_personne JOIN discipline ON discipline.id_discipline = enseigne.id_discipline JOIN categorie ON categorie.id_categorie = enseignant.id_categorie where enseigne.S = :s GROUP BY discipline.id_discipline, discipline.libelleDisc;');
     $requete->bindValue(':s', $s);
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
public function getHeurediscIUT($s,$n){
    $requete =  $this->bd->prepare('SELECT 
    d.libelleDisc AS datay, 
    dept.sigleDept AS label,
    f.nom AS Formation,
    SUM(e.nbHeureEns) AS datax
FROM 
    enseigne e
JOIN 
    discipline d ON e.id_discipline = d.id_discipline
JOIN
    assigner a ON e.id_personne = a.id_personne
JOIN
    departement dept ON a.id_departement = dept.id_departement
JOIN
    formation f ON e.id_formation = f.id_formation
WHERE
    f.id_niveau = :n
AND e.S= :s
GROUP BY
    e.AA,
    e.S,
    d.libelleDisc,
    dept.sigleDept,
    f.nom;');
    $requete->bindValue(':s',$s);
    $requete->bindValue(':n',$n);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
} 
public function getHeurediscIUTDept($id,$s,$n){
    $requete =  $this->bd->prepare('SELECT 
    d.libelleDisc AS datay, 
    dept.sigleDept AS label,
    SUM(e.nbHeureEns) AS datax
FROM 
    enseigne e
JOIN 
    discipline d ON e.id_discipline = d.id_discipline
JOIN
    assigner a ON e.id_personne = a.id_personne
JOIN
    departement dept ON a.id_departement = dept.id_departement
JOIN
    formation f ON e.id_formation = f.id_formation
WHERE
    f.id_niveau = :n and e.S = :s and dept.sigleDept = :id
    
GROUP BY
    e.AA,
    e.S,
    d.libelleDisc,
    dept.sigleDept,
    f.nom;
  
   
   
   ');
    $requete->bindValue(':id', $id);
    $requete->bindValue(':s', $s);
    $requete->bindValue(':n', $n);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}

public function getEnseignantparDept($id){
    $requete =  $this->bd->prepare('SELECT
    c.siglecat AS label,
    ROUND((COUNT(e.id_personne) * 100.0 / total.total_enseignants), 2) AS data
FROM
    departement dept
CROSS JOIN
    categorie c
LEFT JOIN
    assigner a ON dept.id_departement = a.id_departement
LEFT JOIN
    enseignant e ON c.id_categorie = e.id_categorie AND a.id_personne = e.id_personne
JOIN
    (SELECT a.id_departement, COUNT(*) as total_enseignants
     FROM assigner a
     JOIN enseignant e ON a.id_personne = e.id_personne
     GROUP BY a.id_departement) total ON dept.id_departement = total.id_departement
WHERE
    dept.sigledept = :id
GROUP BY
    dept.sigleDept,
    c.sigleCat,
    total.total_enseignants;');
    $requete->bindValue(':id', $id);
    $requete->execute();
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $resultat;
}
public function gethorairestravail($id, $s){
    $requete =  $this->bd->prepare('SELECT  nbHeureens as label ,((servicestatutaire + servicecomplementaireEnseignement) - nbHeureEns) AS data
    FROM enseignant
    JOIN categorie ON categorie.id_categorie = enseignant.id_categorie
    JOIN enseigne ON enseigne.id_personne = enseignant.id_personne
    WHERE enseignant.id_personne = :id and enseigne.S = :s and enseigne.AA = (SELECT EXTRACT(YEAR FROM CURRENT_DATE))');
    $requete->bindValue(':id', $id);
    $requete->bindValue(':s', $s);
    $requete->execute();
    $resultat = $requete->fetch(PDO::FETCH_ASSOC);
    return $resultat;

} 
public function getPersonnes() {
        $requete = $this->bd->prepare('SELECT * FROM personne');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteEnseignantEtPersonne($infos) {

        $id_personne = $this->findByIdPersonne($infos);

        if ($id_personne) {

            $requeteEnseignant = $this->bd->prepare('DELETE FROM enseignant WHERE id_personne = :id_personne');
            $requeteEnseignant->bindValue(':id_personne', $id_personne);
            $requeteEnseignant->execute();


            $nombreDeLignesAffecteesEnseignant = $requeteEnseignant->rowCount();


            $requetePersonne = $this->bd->prepare('DELETE FROM personne WHERE id_personne = :id_personne');
            $requetePersonne->bindValue(':id_personne', $id_personne);
            $requetePersonne->execute();


            $nombreDeLignesAffecteesPersonne = $requetePersonne->rowCount();


            return ($nombreDeLignesAffecteesEnseignant > 0 && $nombreDeLignesAffecteesPersonne > 0);
        } else {

            return false;
        }
    }



    public function findByIdPersonne($id_personne) {
        $requete = $this->bd->prepare('SELECT id_personne FROM personne WHERE id_personne = :id_personne');
        $requete->bindValue(':id_personne', $id_personne);
        $requete->execute();
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);

        if ($resultat) {
            return $resultat["id_personne"];
        } else {
            return false; // Si aucune personne n'est trouvée, renvoyer false
        }
    }  
}
