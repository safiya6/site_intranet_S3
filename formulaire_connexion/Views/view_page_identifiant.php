
    <?php require "view_begin.php";?>

  
  <?php if (isset($_SESSION['prenom']) && isset($_SESSION['role']) && isset($_SESSION["quotite"])): ?>
    <div id="graph-container" style="width: 300px; height: 300px;">
        <canvas width="100px" height="100px" id="graphiqueCercle"></canvas>
    </div>
    <!-- Utilisez directement les données JSON dans votre appel de fonction -->
    <script>graphiqueDoughnut("graphiqueCercle", <?php echo $_SESSION["quotite"]; ?>);</script>
<?php else: ?>
    <p>Vous n'êtes pas connecté</p>
<?php endif; ?>

    
    <?php require "view_end.php";?>
    