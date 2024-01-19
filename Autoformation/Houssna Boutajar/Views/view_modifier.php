
<?php require "view_begin.php"; ?>

<h1> Modifier un film </h1>
<form action="?controller=list&action=modifier" method="post">
    <p> ID du film à modifier : <input name="idfilm" type="text" required/> <br/></p>
    <input type="submit" value="Chercher"/>
</form>

<?php if (isset($film)): ?>
    <form action="?controller=list&action=modifier" method="post">
        <input type="hidden" name="idfilm" value="<?= htmlspecialchars($film['idfilm']) ?>"/>
        <p> Titre : <input name="Titre" type="text" value="<?= htmlspecialchars($film['titre']) ?>"/> <br/>
        Année de sortie: <input name="AnneeSortie" type="text" value="<?= htmlspecialchars($film['anneesortie']) ?>"/> <br/>
        Durée : <input name="Duree" type="text" value="<?= htmlspecialchars($film['duree']) ?>"/> <br/>
        Réalisateur : <input name="Realisateur" type="text" value="<?= htmlspecialchars($film['realisateur']) ?>"/> <br/>
        <input type="submit" value="Modifier"/>
    </form>
<?php endif; ?>

<?php require "view_end.php"; ?>
