<?php

//choix de deux nombres premiers tel que p*q =n
$p = 150060179 ;
$q = 1000601713;
//definition des valeurs de n et φ(n)
$n = $p * $q;
$phi = ($p-1)*($q-1);


//trouver valeur potentiel de e tel que e co-premier avec φ(n) et 1 < e < φ(n)
function find_e($p, $q) {
    global $phi;
    $e_possible = [3, 5, 11, 17, 83, 107, 167, 257, 65537];
    foreach ($e_possible as $e) {
        if (gmp_gcd($e, $phi) == 1) {
            return $e;
        }
    }
    return false;
}

$e = find_e($p,$q);
//definition de d, l'inverse de e modulo φ(n)
$d = (int)gmp_invert($e,$phi);;

//definition des clées publique et privée tel que public_key=(n,e) et private_key(n,d)
$pub_key[]=[$n,$e];
$priv_key[]=[$n,$d];



//chiffre avec public_key
function encryptRSA($message, $e, $n) {
    
    /*
    etape 1:  Convertir le message en une valeur numérique en ascii
    
    array_reduce prend trois arguments : un tableau, une fonction de rappel,
    et une valeur initiale pour le "carry" (ici, 0). Elle applique la fonction
    de rappel à chaque élément du tableau pour réduire le tableau à une seule valeur.
    */
    
    $messageNumeric = array_reduce(str_split($message),
        
        /*
        Multiplie le $carry par 1000 et ajoute le code ASCII du caractère courant. Cette multiplication par
         1000 est une méthode pour s'assurer que les caractères individuels peuvent être récupérés plus tard lors
         du déchiffrement, car chaque caractère ASCII peut être représenté par un nombre jusqu'à 999
        */
         function ($carry, $char) { return ($carry * 1000) + ord($char); }, 0);
   
    // Appliquer chiffrement RSA: c = m^e mod n
    $messageChiffre = bcpowmod($messageNumeric, $e, $n); //bcpowmod sert a calculer des grands nombres, ici : message^e mod n

    return $messageChiffre;
}




//dechiffre avec private_key
function decryptRSA($cipherNumeric, $d, $n) {
    // Appliquer RSA: m = c^d mod n
    $messageNumeric = bcpowmod($cipherNumeric, $d, $n);

    // Convertir le nombre en message (en utilisant les codes ASCII)
    $message = '';
    while ($messageNumeric > 0) {
        $char = chr($messageNumeric % 1000);
        $message = $char . $message;
        $messageNumeric = bcdiv($messageNumeric, '1000');
    }

    return $message;
}




//segmentation en paquet et chiffrement
function paquetRSA($message) {
    global $pub_key;
    $length = strlen($message);
    $result = [];
    
    for ($i = 0; $i < $length; $i += 4) {
        // Découper la chaîne en paquets de 4 caractères
        $paquet = substr($message, $i, 4);

        // Appliquer la fonction encrypt à chaque paquet et stocker le résultat
        
        $result[] = encryptRSA($paquet, $pub_key[0][1], $pub_key[0][0]);
    }

    // Concaténer les résultats avec "-"
    return implode("-", $result);
}


//fusion des paquet et dechiffrement
function depaquetRSA($messageRsa){
    global $priv_key;
    $tab=explode("-",$messageRsa);
    $result = [];
    foreach($tab as $value){
        $result[]=decryptRSA($value,$priv_key[0][1],$priv_key[0][0]);
    }
    return implode('',$result);
}



?>