
<?php
//importation bdd et tests de chiffrement RSA sur table identifiant
//credentials bdd
$dsn = 'pgsql:host=localhost;dbname=sae';
$login = 'postgres';
$mdp = 'NK5u7H8pj!';
$bd;
$bd = new PDO($dsn, $login, $mdp);
$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$bd->query("SET nameS 'utf8'");
?>
<?php
$message="test RSA Module Openssl";
$config = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);
//generation paire de clés priv/pub
$res = openssl_pkey_new($config);
//extraction de la clé privé du $res a $privkey
openssl_pkey_export($res,$privKey);
//extraction de la clé public du $res a $pubkey
$pubKey = openssl_pkey_get_details($res);
$pubKey=$pubKey["key"];

function encryptRSA($data,$publicKey){
    openssl_public_encrypt($data,$encrypted,$publicKey);
    return base64_encode($encrypted);
}
/*
$encryptedWord = encryptRSA($message,$pubKey);
echo $encryptedWord;
*/
function decryptRSA($data,$privateKey){
    openssl_private_decrypt(base64_decode($data),$decrypted,$privateKey);
    return $decrypted;
}
/*
$decryptedWord = decryptRSA($encryptedWord,$privKey);

echo "</br>";
echo "<strong>".$decryptedWord,"</strong>";
*/





$requete = $bd->prepare('SELECT * FROM identifiant');
$requete -> execute();
$tab = $requete->fetchall();

function chiffrerToutMdp(){
    echo "chiffrement";
	global $tab;
    global $pubKey;
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

function dechiffrerToutMdp(){
	echo "dechiffrement";
    global $tab;
    global $privKey;
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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'chiffrer') {
    // Appeler votre fonction ici
    chiffrerToutMdp();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'dechiffrer') {
    // Appeler votre fonction ici
    dechiffrerToutMdp();
}




?>

<form action="RSAmodule.php" method="post">
    <input type="hidden" name="action" value="chiffrer">
    <input type="submit" value="chiffrer ">
</form>

<form action="RSAmodule.php" method="post">
    <input type="hidden" name="action" value="dechiffrer">
    <input type="submit" value="dechiffrer ">
</form>