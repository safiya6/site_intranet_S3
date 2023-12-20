<?php require "view_beginConfirm.php" ?>

        <form action="?controller=D&action=confirmDelete" method="POST">

            <input type="hidden" name="idFilm" value="<?= $idFilm?>">

            <p>Voulez-vous vraiment supprimer le film <?= $titre?> avec l'ID <?= $idFilm?></p>

            <label><input type="radio" name="confirmation" value="oui" required> Oui</label>
            <label><input type="radio" name="confirmation" value="non" required> Non</label>

            <input type="submit" value="Confirmer">
        </form>

<?php require "view_end.php" ?>