<?php

class Model
{
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

    public function getRandomQuestion()
    {
        $req = $this->bd->prepare('SELECT * FROM sondage ORDER BY RANDOM() LIMIT 1');
        $req -> execute();
        $tab = $req->fetchall();
        return $tab;
    }   

    public function getBD()
    {
        $req = $this->bd->prepare('SELECT * FROM sondage ORDER BY id ASC');
        $req -> execute();
        $tab = $req->fetchall();
        return $tab;
    }
    public function getQuestionById($id){
        $req = $this->bd->prepare("SELECT * FROM sondage where id = :id ");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req -> execute();
        $tab = $req->fetchall();

        return $tab;

    }

 // public function getLast()
    //{    
      //  $query = "SELECT * FROM sondage WHERE id = (SELECT MAX(id) FROM sondage)";
      //  $req = $this->bd->prepare($query);
      //  $req -> execute();
    //    $last = $req->fetchall();
  //      return $last; }

    public function deleteById($id){
        $query = 'DELETE FROM sondage WHERE id = :id';
        $req = $this->bd->prepare($query);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req -> execute();



    }

    public function getPopularQuestion() {

        $req = $this->bd->prepare('SELECT * FROM sondage ORDER BY (pour * contre) ');
        $req -> execute();
        $tab = $req->fetchall();
        return $tab;
    }

    public function createQuestion($question,$pour,$contre){
        
        if(is_string($question) && is_int($pour) && is_int($contre)){
            $req = $this->bd->prepare('INSERT INTO sondage (question, pour, contre) VALUES (:question, :pour, :contre)' );
            $req->bindValue(':question', $question, PDO::PARAM_STR);
            $req->bindValue(':pour', $pour, PDO::PARAM_INT);
            $req->bindValue(':contre', $contre, PDO::PARAM_INT);
            $req-> execute();
        }
    }

    public function answerQuestion($id, $typeReponse) {
        // Vérification des types des paramètres
       
        if (is_int($id) && is_bool($typeReponse)) {
            // Utilisation de requête préparée pour éviter les injections SQL
            $req = $this->bd->prepare('UPDATE sondage SET ' . ($typeReponse ? 'pour' : 'contre') . ' = ' . ($typeReponse ? 'pour' : 'contre') . ' + 1 WHERE id = :id');
            $req->bindValue(':id', $id, PDO::PARAM_INT);
            $req->execute();
            
        } 
        
        else {
            return NULL; // ou lancez une exception si vous préférez
        }
    }
  



    // gestion des utilisateurs:


    public function createUser($username,$password,$admin){
        if(is_string($username) && is_string($password) && is_bool($admin))
        {
            $req = $this->bd->prepare('INSERT INTO users (username, password, admin) VALUES (:usr, :passwd, :admin)' );
            $req->bindValue(':usr',$username);
            $req->bindValue(':passwd',$password);
            $req->bindValue(':admin',$admin);
        }
        else{
            echo "pas les bons types";
        }
    }


    public function getUsers(){
        $req = $this->bd->prepare('select * from users');
        $req->execute();
        $tab = $req->fetchall();
        return $tab;
    }
    
    public function getUserByiD($id){
        $req = $this->bd->prepare('select * from users where id = :id');
        $req->bindValue(':id',$id);
        $req->execute();
        $tab = $req->fetchall();
        return $tab;
        
    }
    public function deleteUser($id){
        $query = 'DELETE FROM sondage WHERE id = :id';
        $req = $this->bd->prepare($query);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req -> execute();
    }
    





}

?>