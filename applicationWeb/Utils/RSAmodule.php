<?php


require 'keys.php';
$privKey = PRIVATE_KEY;
$pubKey = PUBLIC_KEY;


//verifie si bdd chiffré ou pass
function verifMdp($tab){
    foreach($tab as $row){
		$id = $row[0];
		$mdp = $row[1];
		$nb344=0;
        $nbTot=0;
        if(strlen($mdp) == 344){
            $nb344++;
            $nbTot++;
        }
        else{
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


function encryptRSA($data,$publicKey){
    openssl_public_encrypt($data,$encrypted,$publicKey);
    return base64_encode($encrypted);
}

function decryptRSA($data, $privateKey) {
    if (!openssl_private_decrypt(base64_decode($data), $decrypted, $privateKey)) {
        die("Erreur lors du déchiffrement : " . openssl_error_string());
    }
    return $decrypted;
    
    echo "dechiffrement";
}




