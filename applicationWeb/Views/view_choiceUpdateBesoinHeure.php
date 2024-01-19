<?php require "view_begin_visualisation.php"; $title = 'Choix Heure' ?> 
<?php   if (isset($_SESSION['prenom']) && isset($_SESSION['role'])): ?>

<h1>Modifier le Besoin en Heure</h1>
<div id ="form">
<form action="?controller=update&action=updateBesoinHeure" method="post">
    
    <?php foreach ($data as $cle => $value): ?>
    <input type="hidden" value="<?php echo $value; ?>" id="<?php echo $cle; ?>" name="<?php echo $cle; ?>">
    <?php endforeach; ?>    
    <p>Le besoin en heure était de <?= $data["ancienBesoinHeure"] ?>, <br/>
    à combien voulez-vous le fixer maintenant ? <input type='number' name='besoin_heure' id='besoin_heure' value='<?= $data["ancienBesoinHeure"] ?>'> </p>
    <input type="submit" value='Modifier le besoin en heure'>

</form>
    </div>
<?php else: ?>
  <p>Vous n'êtes pas connecté</p>
<?php endif; ?>
<?php require "view_end.php"; ?>