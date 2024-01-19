
<?php require "view_begin.php"; ?>

<h1>Supprimer un film</h1>
<form action="?controller=list&action=supprimer" method="post">
    <p>Nom du film à supprimer : <input name="nomFilm" type="text" required/></p>
    <p><input type="submit" value="Supprimer"/></p>
</form>

<?php require "view_end.php"; ?>
