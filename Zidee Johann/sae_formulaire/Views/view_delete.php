<?php require "view_begin.php"?>

<form action="?controller=D&action=default" method='POST'>
    
    <label for="idFilm">Id du Film:</label>
    <input type="number" name="idFilm" required>

    <input type="submit" value="Supprime le Film">
</form>

<?php require "view_end.php" ?>
