<?php require "view_begin.php"?>

<?php session_start();if (isset($_SESSION['prenom']) && isset($_SESSION['role'])): ?>
<?php var_dump($_SESSION)?>
    <div class="graph-container" style="width: 600px; height: 600px;">
        <h1> quotite par departement</h1>
            <canvas width="100px" height="100px" id="graphiqueCercle"></canvas>
    </div>

    <div>

<script>graphiqueDoughnut("graphiqueCercle", <?php echo $_SESSION["quotite"]; ?>,'quotite par departement');</script>
<?php else: ?>
  <p>Vous n'êtes pas connecté</p>
<?php endif; ?>
<?php require "view_end.php" ;?>