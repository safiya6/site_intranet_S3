<?php 
session_start();

$_SESSION["dejaExec"] = true;
if (isset( $SESSION["dejaExec"]) &&  $SESSION["dejaExec"] === true){
    unset($_POST);
   }
   else
   {
    $SESSION["dejaExec"] = true;
   }

// Fonctions de cryptographie
function genKey() {
    $config = array(
        "digest_alg" => "sha512",
        "private_key_bits" => 2048,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
    );

    // Génération de la paire de clés
    $res = openssl_pkey_new($config);

    // Extraction de la clé privée
    openssl_pkey_export($res, $privKey);

    // Extraction de la clé publique
    $pubKeyDetails = openssl_pkey_get_details($res);
    $pubKey = $pubKeyDetails["key"];

    // Chemin du fichier pour stocker les clés
    $file = 'keys.php';

    // Contenu à écrire dans le fichier
    $content = "<?php\n";
    $content .= "define('PRIVATE_KEY', '".addslashes($privKey)."');\n";
    $content .= "define('PUBLIC_KEY', '".addslashes($pubKey)."');\n";
    $content .= "?>";

    // Écriture des clés dans le fichier avec fopen, fwrite, fclose
    $fileHandle = fopen($file, 'w');
    if ($fileHandle) {
        fwrite($fileHandle, $content);
        fclose($fileHandle);
    } else {
        echo "Erreur : Impossible d'écrire dans le fichier.";
    }
    
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'gen' && $_SESSION["dejaExec"] != true) {
        $keys = genKey();
        echo "clées généré";
    }
    else{
        echo "deja fait, pour des raisons de sécurité, vous ne pouvez pas regenerer des clées ";
    }
}
?>

<form action="genKeys.php" method="post">
    <input type="hidden" name="action" value="gen">
    <input type="submit" value="Générer paire de clés">
</form>