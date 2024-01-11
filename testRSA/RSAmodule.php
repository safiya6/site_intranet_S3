<?php
include 'keys.php';
$privKey = PRIVATE_KEY;
$pubKey = PUBLIC_KEY;


// Paramètres de connexion à la base de données
$dsn = 'pgsql:host=localhost;dbname=sae';
$login = 'postgres';
$mdp = 'NK5u7H8pj!';
$bd = new PDO($dsn, $login, $mdp);
$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$bd->query("SET nameS 'utf8'");
//recuperation de la table identifiant  la bd
$requete = $bd->prepare('SELECT * FROM identifiant');
$requete -> execute();
$tab = $requete->fetchall();

function verifMdp(){
    global $tab;
    foreach($tab as $row){
		$id = $row[0];
		$mdp = $row[1];
		$nb344=0;
        $nbTot=0;
        echo strlen($mdp);
        if(strlen($mdp) == 344){
            echo "344";
            $nb344++;
            $nbTot++;
        }
        else{
            echo "pas 344";
            $nbTot++;
        }
    }
    if($nb344==$nbTot){
        return strlen($mdp);
    }
    else{
        return 0;
    }
} 
$taille = verifMdp();

echo '</br>';
echo 'taille :'.$taille;


function encryptRSA($data,$publicKey){
    openssl_public_encrypt($data,$encrypted,$publicKey);
    return base64_encode($encrypted);
}

function decryptRSA($data, $privateKey) {
    echo "data".$data;
    echo base64_decode($data);
    if (!openssl_private_decrypt(base64_decode($data), $decrypted, $privateKey)) {
        die("Erreur lors du déchiffrement : " . openssl_error_string());
    }
    return $decrypted;
    
    echo "dechiffrement";
}


// Fonctions pour chiffrer et déchiffrer tous les mots de passe


function chiffrerToutMdp(){
	global $tab;
    global $pubKey;
    global $taille;
    if($taille!=344){
        
        $dsn = 'pgsql:host=localhost;dbname=sae';
        $login = 'postgres';
        $mdp = 'NK5u7H8pj!';
        $bd;
        $bd = new PDO($dsn, $login, $mdp);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bd->query("SET nameS 'utf8'");
        
        foreach($tab as $row){
            $id = $row[0];
            
            $mdp = $row[1];
            var_dump($mdp);

            $mdpRSA=encryptRSA($mdp,$pubKey);
            var_dump($mdpRSA);
            $req=$bd->prepare("UPDATE identifiant SET mdp='".$mdpRSA."' WHERE ide='".$id."'");
        
            $req->execute();
        }
    }
    else{
        echo "skip, la bdd est deja chiffré";
    }
}


function dechiffrerToutMdp(){
    global $tab;
    global $privKey;
    global $taille;
    if($taille==344){
        $dsn = 'pgsql:host=localhost;dbname=sae';
        $login = 'postgres';
        $mdp = 'NK5u7H8pj!';
        $bd;
        $bd = new PDO($dsn, $login, $mdp);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bd->query("SET nameS 'utf8'");
        foreach($tab as $row){
            $id = $row[0];
            $mdp = $row[1];
            var_dump($mdp);
            $mdpRSA=decryptRSA($mdp,$privKey);
            var_dump($mdpRSA);
            $req=$bd->prepare("UPDATE identifiant SET mdp='".$mdpRSA."' WHERE ide='".$id."'");
            $req->execute();
        }
    }
    else{
        echo "skip, deja dechiffré";
    }
}


// Traitement des actions de l'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   if ($_POST['action'] === 'chiffrer') {
        chiffrerToutMdp($bd, $pubKey);
    } elseif ($_POST['action'] === 'dechiffrer') {
        dechiffrerToutMdp($bd, $privKey);
    }
}
?>

<!-- Formulaires pour les actions de l'utilisateur -->


<form action="RSAmodule.php" method="post">
    <input type="hidden" name="action" value="dechiffrer">
    <input type="submit" value="Déchiffrer">
</form>

<form action="RSAmodule.php" method="post">
    <input type="hidden" name="action" value="chiffrer">
    <input type="submit" value="Chiffrer">
</form>