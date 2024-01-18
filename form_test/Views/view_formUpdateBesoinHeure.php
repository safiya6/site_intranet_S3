<?php require "view_begin_visualisation.php"; $title = "Modifier Besoin Heure"?>

<?php if (isset($_SESSION['prenom']) && isset($_SESSION['role'])): ?>
<h1>Modifier le Besoin en Heure</h1>
<div id="form">
<form action="?controller=update&action=choiceUpdateBesoinHeure" method="post">

    <p>Quel besoin en heure voulez-vous modifier ?</p>

    <label for="aa"> Année : </label>
    <select name="aa" id="aa">
         <?php foreach ($annees as $annee): ?>
            <option value="<?php echo $annee['aa']; ?>">
                <?php echo $annee['aa']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="s"> Semestres : </label>
    <select name="s" id="s">
    <option value="1">1</option>
    <option value="2">2</option>
    </select>

    <label for="id_formation">Formation :</label>
    <select name="id_formation" id="id_formation">
        <?php foreach($formations as $formation): ?>
            <option value="<?php echo $formation['id_formation']; ?>">
            <?php echo $formation['nom'], " " , $formation['id_niveau']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="id_discipline"> Discipline : </label>
    <select name="id_discipline" id="id_discipline">
         <?php foreach ($disciplines as $discipline): ?>
            <option value="<?php echo $discipline['id_discipline']; ?>">
                <?php echo $discipline['libelledisc']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="id_departement"> Département : </label>
    <select name="id_departement" id="id_departement">
         <?php foreach ($departements as $departement): ?>
            <option value="<?php echo $departement['id_departement']; ?>">
                <?php echo $departement['libelledept']; ?>
            </option>
        <?php endforeach; ?>
    </select>


    <input type="submit" value="Modifier ce besoin."/>
</form>
         </div>
<?php else: ?>
  <p>Vous n'êtes pas connecté</p>
<?php endif; ?>
<?php require "view_end.php"; ?>
