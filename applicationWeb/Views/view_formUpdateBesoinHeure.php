<?php require "view_begin_visualisation.php"; $title = "Modifier Besoin Heure";?>

<?php if (isset($_SESSION['prenom']) && isset($_SESSION['role'])): ?>
<h1>Modifier le Besoin en Heure</h1>
<div id="form">

<form action="?controller=update&action=choiceUpdateBesoinHeure" method="post">

    <p>Quel besoin en heure voulez-vous modifier ?</p>


    <select name="ligne" id="ligne">  
         <?php foreach ($disciplines as $cle => $discipline): ?>
            <option value="<?php echo $cle; ?>">
            <?php echo $discipline['libelledisc'] . ' | S : ' . $discipline['s'] . ' | Année : ' . $discipline['aa'] . ' | Département : ' . $discipline['libelledept'] . ' | Formation : ' . $discipline['nom'] .' | Niveau : ' . $niveaux[$discipline['id_niveau']]; ?>
            </option>
        <?php endforeach; ?>
    </select><br/>
    

    <input type="submit" value="Modifier ce besoin."/>
</form>

         </div>
<?php else: ?>
  <p>Vous n'êtes pas connecté(e)</p>
<?php endif; ?>
<?php require "view_end.php"; ?>