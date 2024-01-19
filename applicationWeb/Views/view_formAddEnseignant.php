<?php require "view_begin_visualisation.php"; $title = "Ajouter un enseignant"?>
<?php   if (isset($_SESSION['prenom']) && isset($_SESSION['role'])): ?>

<h1>Ajouter un enseignant</h1>
<div id="form">
<form action="?controller=add&action=addEnseignant" method="post">

    <p>Nom : <input type = "text" name = 'nom' id = 'nom'>
       Prénom : <input type = "text" name = 'prenom' id = 'prenom'>
       Email : <input type = "mail" name = 'email' id = 'email'></p>
    
    
    
    <label for="aa"> Année : </label>
    <select name="aa" id="aa">  
         <?php foreach ($annees as $annee): ?>
            <option value="<?php echo $annee['aa']; ?>">
                <?php echo $annee['aa']; ?>
            </option>
        <?php endforeach; ?>
    </select><br/>

    <label for="id_categorie">Catégorie :</label>
    <select name="id_categorie" id="id_categorie">
        <?php foreach($categories as $categorie): ?>
            <option value="<?php echo $categorie['id_categorie']; ?>">
                <?php echo $categorie['libellecat']; ?>
            </option>
        <?php endforeach; ?>
    </select><br/>


    <label for="id_discipline"> Discipline : </label>
    <select name="id_discipline" id="id_discipline">  
         <?php foreach ($disciplines as $discipline): ?>
            <option value="<?php echo $discipline['id_discipline']; ?>">
                <?php echo $discipline['libelledisc']; ?>
            </option>
        <?php endforeach; ?>
    </select><br/>

    <input type="submit" value="Ajouter cet(te) enseignant(e)."/>
</form>
         </div>
<?php else: ?>
  <p>Vous n'êtes pas connecté</p>
<?php endif; ?>
<?php require "view_end.php"; ?>
