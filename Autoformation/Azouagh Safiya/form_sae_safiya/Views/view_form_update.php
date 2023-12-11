<?php require "view_begin.php"; ?>


<h1> Met à jour ton film </h1>

<form action = "?controller=crud&action=create" method="post">
    <p> <label for ="id"> id: <input type="text" name="id" required /> </label></p>
    <p> <label for ="titre"> Titre: <input type="text" name="titre" required /> </label></p>
    <p> <label> Genre: <input type="text" name="genre"/> </label></p>
    <p> <label> Durée: <input type="text" name="duree"/></label> </p>
    <p> <label> Année de sortie: <input type="text" name="anneesortie"/> </label></p>
    <p> <label> Réalisateur: <input type="text" name="realisateur"/></label> </p>


    <p>  <input type="submit" value="mettre à jour ma base de donnée"/> </p>
</form>
<?php if (isset($_POST["id"]) and isset($_POST["titre"]) and isset($_POST["genre"]) 
            and isset($_POST["duree"]) 
            and isset($_POST["anneesortie"]) 
            and isset($_POST["realisateur"])) :?>
<table>
<tr><th>titre</th><th>genre</th><th> année de sortie</th><th> réalisateur</th></tr>
<tr><td><?= e($resultat['id'])?></td><td><?= e($resultat['titre'])?></td><td><?= e($resultat['genre'])?> </td><td> <?= e($resultat['anneesortie']) ?> </td><td> <?= e($resultat['realisateur']) ?> </td></tr>
</table>
<?php endif ; ?>




<?php require "view_end.php"; ?>
