<?php require "view_begin_visualisation.php"; $title = "supprimer enseignant"?>

<?php   if (isset($_SESSION['prenom']) && isset($_SESSION['role'])): ?>
<div id="form">

<h1>Supprimer un enseignant</h1>
<form action="?controller=delete&action=deleteEnseignant" method="post">

    <label for="id_personne">Choisir l'enseignant :</label>
    <select name="id_personne" id="id_personne">
        <?php foreach($personnes as $personne): ?>
            <option value="<?php echo $personne['id_personne']; ?>">
                <?php echo $personne['id_personne'], ' ', $personne['nom'], ' ', $personne['prenom']; ?>
            </option>
        <?php endforeach; ?>
    </select><br/>

    <input type="submit" value="Supprimer cet(te) enseignant(e)">
</form>
</div>
<?php else: ?>
  <p>Vous n'êtes pas connecté</p>
<?php endif; ?>

<?php require "view_end.php"; ?>