<?php require "view_begin.php" ;echo "probleme";
session_start();
$_SESSION["semestre"]=1;
<script>graphiquePie("graphiqueC", <?php echo ; ?>);</script>
<?php require "view_end.php"?>