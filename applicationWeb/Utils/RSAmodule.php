<?php
require 'keys.php';

$privKey = PRIVATE_KEY;
$pubKey = PUBLIC_KEY;

// Fonction qui vérifie si les mots de passe de la base de données sont chiffrés
function verifMdp($tab)
{
    $nb344 = 0;
    $nbTot = 0;

    foreach ($tab as $row) {
        $id = $row[0];
        $mdp = $row[1];

        // Vérification de la longueur du mdp
        if (strlen($mdp) == 344) {
            $nb344++;
            $nbTot++;
        } else {
            $nbTot++;
        }
    }

    // Si tous les mots de passe sont de longueur 344, la base de données est chiffrée
    if ($nb344 == $nbTot) {
        return strlen($mdp);
    } else {
        return 0;
    }
}

// chiffrement RSA
function encryptRSA($data, $publicKey)
{
    // Chiffrement  avec la clé publique
    openssl_public_encrypt($data, $encrypted, $publicKey);

    
    return base64_encode($encrypted);
}

// fonction de déchiffrement 
function decryptRSA($data, $privateKey)
{
    // Déchiffrement de la donnée en base64 avec la clé privée
    if (!openssl_private_decrypt(base64_decode($data), $decrypted, $privateKey)) {
        die("Erreur lors du déchiffrement : " . openssl_error_string());
    }

   
    return $decrypted;
    // Note : la ligne 'echo "dechiffrement";' ne sera jamais exécutée car elle est suivie par un 'return'
}
?>
