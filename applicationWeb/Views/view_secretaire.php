<?php require "view_begin.php"?>
<?php if (isset($_SESSION['prenom']) && isset($_SESSION['role'])): ?>
<?php var_dump($_SESSION) ?>
<div class="graph-container" style="width: 600px; height: 600px;">
        <h1> complementaire vs statutaire</h1>
      <canvas width="100px" height="100px" id="graphiqueC"></canvas>

  </div>
  
  <script>graphiqueCamenbert("graphiqueC", <?php echo $_SESSION["pourcentage"]; ?>);</script>

<?php else: ?>
  <p>Vous n'êtes pas connecté</p>
<?php endif; ?>
<?php require "view_end.php" ;?>