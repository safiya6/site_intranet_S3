<?php require "view_begin.php";
session_start();?>

<script>graphiquePie("graphiqueC", <?php echo $_SESSION["pourcentage"]; ?>);</script>
<?php require "view_end.php"?>