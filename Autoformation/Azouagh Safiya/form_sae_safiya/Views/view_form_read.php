<?php require "view_begin.php"; ?>


<h1> trouve ton film en selectionnant sont id</h1>

<form action = "?controller=crud&action=read" method="post">
    
    <p> <label> id: <input type="text" name="id"/> </label></p>



    <p>  <input type="submit" value="voir les données"/> </p>
</form>
<?php if (isset($_POST["id"]) ):?>
<table>
<tr><th>titre</th><th>genre</th><th> année de sortie</th><th> réalisateur</th></tr>
<tr><td><?= e($resultat['titre'])?></td><td><?= e($resultat['genre'])?> </td><td> <?= e($resultat['anneesortie']) ?> </td><td> <?= e($resultat['realisateur']) ?> </td></tr>
</table>
<?php endif ; ?>





<?php require "view_end.php"; ?>
