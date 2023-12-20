<?php

class Model {
    /**
     * Attribut contenant l'instance PDO
     */
    private $bd;

    /**
     * Attribut statique qui contiendra l'unique instance de Model
     */
    private static $instance = null;

    /**
     * Constructeur : effectue la connexion à la base de données.
     */
    private function __construct()
    {
        include "credentials.php";
        $this->bd = new PDO($dsn, $login, $mdp);
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->bd->query("SET nameS 'utf8'");
    }

    /**
     * Méthode permettant de récupérer un modèle car le constructeur est privé (Implémentation du Design Pattern Singleton)
     */
    public static function getModel()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getFilms()
    {
        $requete = $this->bd->prepare('SELECT * FROM films');
        $requete->execute();
        return $requete->fetchall();
    }

    public function getAjoutFilm($infos)
    {
        $requete = $this->bd->prepare('INSERT INTO films (titre, genre, duree, anneeSortie, realisateur)VALUES (:titre, :genre, :duree, :anneeSortie, :realisateur)');

        //Remplacement des marqueurs de place par les valeurs
        $marqueurs = ['titre', 'genre', 'duree', 'anneeSortie', 'realisateur'];

        foreach ($marqueurs as $value) {
            $requete->bindValue(':' . $value, $infos[$value]);
        }

        $requete->execute();
        return (bool) $requete->rowCount();
    }

    public function getUpdateFilm($infos)
    {
        $requete = $this->bd->prepare('UPDATE films SET titre = :titre, genre = :genre, duree = :duree, anneeSortie = :anneeSortie, realisateur = :realisateur WHERE idFilm = :idFilm');
        $marqueurs = ['idFilm', 'titre', 'genre', 'duree', 'anneeSortie', 'realisateur'];

        foreach ($marqueurs as $value) {
            $requete->bindValue(':' . $value, $infos[$value]);
        }

        $requete->execute();
        return (bool) $requete->rowCount();
    }

    public function getDeleteFilm($id)
    {
        $requete = $this->bd->prepare("DELETE FROM films WHERE idFilm = :idFilm");
        $requete->bindValue(':idFilm', (int) $id, PDO::PARAM_INT);
        $requete->execute();
        return (bool) $requete->rowCount();
    }

    public function getIdExist($id) 
    {
        $requete = $this->bd->prepare('SELECT COUNT(*) FROM films WHERE idFilm = :idFilm');
        $requete->bindValue(':idFilm', $id, PDO::PARAM_INT);
        $requete->execute();
        $count = $requete->fetchColumn();
        return $count > 0;
    }

    public function getFilmById($id)
    {
        $requete = $this->bd->prepare('SELECT * FROM films WHERE idFilm = :idFilm');
        $requete->bindValue(':idFilm', (int) $id, PDO::PARAM_INT);
        $requete->execute();
        return $requete->fetch(PDO::FETCH_ASSOC);
    }

}