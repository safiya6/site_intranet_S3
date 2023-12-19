<?php require "view_begin.php"?>

<form action="?controller=Update&action=AjoutFilm" method='post'>
    
    <label for="idFilm">Id du Film:</label>
    <input type="number" name="idFilm" required>


    <label for="titre">Titre du Film:</label>
    <input type="text" name="titre" required>

    <label for="genre">Genre:</label>
    <input type="text" name="genre" required>

    <label for="duree">Durée (en minutes):</label>
    <input type="number" name="duree" required>

    <label for="anneesortie">Année de Sortie:</label>
    <input type="text" name="anneeSortie" required>

    <label for="realisateur">Réalisateur:</label>
    <input type="text" name="realisateur" required>

    <input type="submit" value="Update le Film">
</form>

<?php require "view_end.php" ?>
