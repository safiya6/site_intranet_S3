<?php require "view_begin.php" ?>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idFilm']) && is_numeric($_POST['idFilm'])): ?>
    <?php $idFilm = htmlspecialchars($_POST['idFilm']); ?>
    <form action="?controller=Delete&action=SuppressionFilm" method='POST'>
        <input type='hidden' name='idFilm' value='<?= $idFilm; ?>'>
        <p>Êtes-vous sûr de vouloir supprimer le film avec l'ID <?= $idFilm; ?> ?</p>
        <input type='submit' value='Confirmer la suppression'>
    </form>
<?php else: ?>
    <form action="?controller=Delete&action=default" method='POST'>
        <label for="idFilm">Id du Film:</label>
        <input type="number" name="idFilm" required>
        <input type="submit" value="Supprimer le Film">
    </form>
<?php endif; ?>

<?php require "view_end.php" ?>
