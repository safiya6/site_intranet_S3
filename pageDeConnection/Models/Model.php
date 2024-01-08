<?php
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
    public function recuperer_donnee($id){
        $requete = $this->bd->prepare('SELECT * from personne where id_personne = :id ');
        $requete->bindValue(':id', $id);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    public function est_connecte($id, $mdp) {
        $requete = $this->bd->prepare('SELECT * from identifiant where ide = :id and mdp = :mdp');
        $requete->bindValue(':id', $id);
        $requete->bindValue(':mdp', $mdp);
        $requete->execute();
    
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat !== false;
    }
    public function est_enseignant($id)
    {
        $requete = $this->bd->prepare('SELECT * from enseignant where enseignant.id_personne = ');
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
    public function est_directeur($id)
    {
        $requete = $this->bd->prepare('SELECT * from  directeur where directeur.id_personne = :id ');
        $requete->bindValue(':id', $id);
        $requete->execute();

        $resultat = $requete->fetch(PDO::FETCH_ASSOC);
        return $resultat !== false;

    }
    public function cypherAllPassword(){
        $requete = $this->bd->prepare('SELECT * from  identifiant ');
        $requete->execute();
        $resultat = $requete->fetchall(PDO::FETCH_ASSOC);
        $tailleTab = sizeof($resultat);
        
        
        for($i=0; $i<$tailleTab;$i++)
        {
            $mdp = $resultat[$i]['mdp'];
            $ide = $resultat[$i]['ide'];

            $mdpRSA = paquetRSA($mdp);
            $req = $this->bd->prepare('UPDATE identifiant SET mdp = :mdp WHERE ide = :ide');
            $req->bindValue(':mdp', $mdpRSA);
            $req->bindValue(':ide', $ide);
            $req->execute();

        }
        
        var_dump($resultat);
        return $resultat;
    }
   
}