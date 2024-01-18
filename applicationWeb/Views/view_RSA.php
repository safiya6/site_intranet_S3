<?php
require "view_begin.php";
if(!isset($data[0])){
   $data[0]="NULL";
}
if(!isset($etat)){
    $etat=0;
}
if(!isset($bdd)){
    $bdd=0;
}
?>



<form action="?controller=RSA&action=dechiffrerBDD" method="post">
    <input type="hidden" name="action" value="dechiffrer">
    <input type="submit" value="Déchiffrer">
</form>

<form action="?controller=RSA&action=chiffrerBDD" method="post">
    <input type="hidden" name="action" value="chiffrer">
    <input type="submit" value="Chiffrer">
</form>   


<p>etat du chiffrement : <?=  ($etat ? 'chiffré':'dechiffré') ?></p>
<p>reponse de la bdd : <?= $bdd?></p>
<?php require "view_end.php" ?>