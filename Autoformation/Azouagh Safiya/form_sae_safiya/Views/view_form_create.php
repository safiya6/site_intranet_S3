<?php require "view_begin.php" ?>



<h1> Ajouter un film Disney</h1>

<form action = "?controller=crud&action=create" method="post">
    <p> <label for ="titre"> Titre: <input type="text" name="titre" required /> </label></p>
    <p> <label> Genre: <input type="text" name="genre"/> </label></p>
    <p> <label> Durée: <input type="text" name="duree"/></label> </p>
    <p> <label> Année de sortie: <input type="text" name="anneesortie"/> </label></p>
    <p> <label> Réalisateur: <input type="text" name="realisateur"/></label> </p>


    <p>  <input type="submit" value="Ajouter dans ma base de donnée"/> </p>
</form>

<?php require "view_end.php" ?>