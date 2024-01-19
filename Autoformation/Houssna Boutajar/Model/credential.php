<?php
$host = "localhost"; 

$dbname = "Formulairetest";
$user = "houssna";
$password = "houssna";

// Création d'une chaîne DSN pour PDO
$dsn = "pgsql:host=$host;dbname=$dbname;user=$user;password=$password";

try {
    // Création d'une instance PDO avec la chaîne DSN
    $db = new PDO($dsn);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
