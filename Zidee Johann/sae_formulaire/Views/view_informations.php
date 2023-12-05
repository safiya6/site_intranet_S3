<?php require "view_begin.php"?>

<form action="?controller=C&action=default" method='POST'>
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

    <input type="submit" value="Ajoute le Film">
</form>

<?php require "view_end.php" ?>
