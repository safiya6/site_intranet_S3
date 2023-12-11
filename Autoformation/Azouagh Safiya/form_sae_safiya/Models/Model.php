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

    public function create($info)
    {
        $requete = $this->bd->prepare('INSERT into Films (Titre, Genre ,Duree ,AnneeSortie, Realisateur ) VALUES(:titre, :genre , :duree,  :anneesortie,  :realisateur)');

  
        $marqueurs = ['titre', 'genre', 'duree', 'anneesortie', 'realisateur'];

        foreach ($marqueurs as $value) {
            $requete->bindValue(':' . $value, $info[$value]);
        }

        $requete->execute();

        return (bool) $requete->rowCount();
    }

    public function delete($id)
    {
        $requete = $this->bd->prepare("DELETE FROM Films WHERE idfilm = :id");
        $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $requete->execute();
        return (bool) $requete->rowCount();
    }


    public function read($id)
    {
        $requete = $this->bd->prepare('Select * from Films WHERE idfilm = :id');
        $requete->bindValue(':id', $id);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }


    public function update($info)
    {
        $requete = $this->bd->prepare('UPDATE Films SET Titre = :titre, Genre  = :genre , Duree = :duree, AnneeSortie = :anneesortie, Realisateur = :realisateur where idfilm= :idfilm');

        $marqueurs = ['idfilm','titre', 'genre', 'duree', 'anneesortie', 'realisateur'];

        foreach ($marqueurs as $value) {
            $requete->bindValue(':' . $value, $info[$value]);
        }

        
        $requete->execute();

        return (bool) $requete->rowCount();
    }

    public function voirtout()
    {
        $requete = $this->bd->prepare('SELECT * FROM Films');

        
        $requete->execute();

        return $requete->fetchAll(PDO::FETCH_ASSOC) ;
    }

   
}
