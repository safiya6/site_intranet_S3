<?php

class Model
{
    private $bd;

    private static $instance = null;

    private function __construct()
    {
        include "Utils/credentials.php";
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

    public function getAttractions($size)
    {
        $req = $this->bd->prepare('SELECT * FROM attractions WHERE taille_min_accompagnee <='.$size.' OR taille_min_seul <='.$size);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

}