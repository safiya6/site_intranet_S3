<?php require "view_begin.php"?>

        <form action="?controller=D&action=redirection" method="POST">
            
            <label for="idFilm">Id du Film:</label>
            <input type="number" name="idFilm" required>

            <input type="submit" value="Suppression du film">
        </form>

<?php require "view_end.php" ?>