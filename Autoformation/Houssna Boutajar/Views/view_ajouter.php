<!-- Vue ajouter.php -->
<?php require "view_begin.php"; ?>

<h1> Ajouter un film </h1>
<form action="?controller=list&action=ajouter" method="post">
    <p> Titre : <input name="Titre" type="text" required/> <br/></p>
    <p> Année de sortie: <input name="AnneeSortie" type="text" required/> <br/></p>
    <p> Durée (en minutes) : <input name="Duree" type="text" required/> <br/></p>
    <p> Réalisateur : <input name="Realisateur" type="text" required/> <br/></p>
    <p> Genre : <input name="Genre" type="text" required/> <br/></p>
    <p> ID du film : <input name="idfilm" type="text" required/> <br/></p>
    <p><input type="submit" value="Ajouter"/></p>
</form>

<?php require "view_end.php"; ?>
