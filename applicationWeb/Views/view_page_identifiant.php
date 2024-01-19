
<?php require "view_begin_visualisation.php";?>
  
<?php  if (isset($_SESSION['prenom']) && isset($_SESSION['role'])): ?>
  
  <div class= "form">  
      <form action="?controller=page&action=recupSemestre" method="post">
        <label for="semestre1">Semestre 1
        <input type="radio" id="semestre1" name="semestre" value="1" <?= ($_SESSION['semestre'] == 1) ? 'checked' : ''; ?>>
</label>
        <label for="semestre2">Semestre 2
        <input type="radio" id="semestre2" name="semestre" value="2" <?= ($_SESSION['semestre'] == 2) ? 'checked' : ''; ?>>
        </label>
        <label>
        <div class="cote">
        <input type="submit" value="Choisir">
        </div>
</label>
      </form>
    </div>

    <div class= "form">  
      <form action="?controller=page&action=recupNiveau" method="post">
        <label for="BUT1">BUT1
        <input type="radio"  name="niveau" value="1" <?= ($_SESSION['niveau'] == 1) ? 'checked' : ''; ?>>
</label>
        <label for="BUT2">BUT 2
        <input type="radio" name="niveau" value="2" <?= ($_SESSION['niveau'] == 2) ? 'checked' : ''; ?>>
        </label>
        <label for="BUT3">BUT 3
        <input type="radio"  name="niveau" value="3" <?= ($_SESSION['niveau'] == 3) ? 'checked' : ''; ?>>
        </label>
        <label for="LP3">LP 3
        <input type="radio"  name="niveau" value="4" <?= ($_SESSION['niveau'] == 4) ? 'checked' : ''; ?>>
        </label>
        <label>
        <div class="cote">
        <input type="submit" value="Choisir">
        </div>
</label>
      </form>
    </div>
<div class="graph-container-parent">
    
   
  <script>graphiqueDoughnut("graphiqueCercle", <?php echo $_SESSION["quotite"]; ?>,'quotite par departement','quotite par département');</script>
  
  <script>graphiqueCamenbert("graphiqueC1", <?php echo $_SESSION["enseigneDept"]; ?>,'catégorie agent pour votre département');</script>
  <script>graphiqueCamenbert("graphiqueC", <?php echo $_SESSION["pourcentage"]; ?>,'pourcentage agent');</script>
   <script>
    var heureensData = <?php echo $_SESSION["heureens"]; ?>;
   graphiqueCamenbert2label("graphiqueC2", heureensData ,'heures enseignées VS heures libres',"heure enseignées","heures libres");</script>


  <script>graphiqueBar("graphiqueB", <?php echo $_SESSION["S_vs_C"]; ?> ,'service statutaire','service complémentaire','service statutaire VS complémentaire  ');</script>

  
  <script>graphiqueBarresHorizontales("graphiqueBH", <?php echo $_SESSION["HeurediscIUT"] ?>,"Discipline par département selon la formation ");</script>

  
  <script>graphiqueBarresHorizontales("graphiqueBH2", <?php echo $_SESSION["HeurediscIUTDept"]?>,"Discipline pour le departement <?= $_SESSION['departement']?> semestre:<?= $_SESSION['semestre']?>, niveau: <?= $_SESSION['niveau']?>");</script>
</div>
  <?php else: ?>
  <p>Vous n'êtes pas connecté</p>
<?php endif; ?>

  
  <?php require "view_end.php";?>
  