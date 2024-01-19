<?php

class Model {
    private $bd;
    private static $instance = null;

    private function __construct() {
        include "credential.php";
        $dsn = "pgsql:host=$host;dbname=$dbname;user=$user;password=$password";
        try {
            $this->bd = new PDO($dsn, $user, $password);
            $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->bd->query("SET NAMES 'utf8'");
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public static function getModel() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function listerfilms() {
        $requete = $this->bd->prepare('SELECT * FROM films');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ajouterFilm($infos) {
        $requete = $this->bd->prepare('INSERT INTO Films (titre, anneesortie, duree, realisateur, genre, idfilm) VALUES (:titre, :anneesortie, :duree, :realisateur, :genre, :idfilm)');
        foreach ($infos as $cle => $valeur) {
            $requete->bindValue(':'.$cle, $valeur);
        }

        $success = $requete->execute();

        return (bool) $success;
    }

    public function modifierFilm($infos) {
        $requete = $this->bd->prepare('UPDATE Films SET idfilm = :idfilm, titre = :titre, genre = :genre, duree = :duree, anneesortie = :anneesortie, realisateur = :realisateur WHERE id = :id');
        $marqueurs = ['idfilm', 'titre', 'genre', 'duree', 'anneesortie', 'realisateur', 'id'];
        
        foreach ($marqueurs as $value) {
            $requete->bindValue(':' . $value, $infos[$value]);
        }

        $success = $requete->execute();

        return (bool) $success;
    }

    public function supprimerFilmParNom($nom) {
        $requete = $this->bd->prepare('DELETE FROM films WHERE titre = :titre');
        $requete->bindValue(':titre', $nom);
        $requete->execute();
    }
}

?>
