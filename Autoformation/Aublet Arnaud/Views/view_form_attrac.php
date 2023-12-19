<?php require "view_begin.php"; ?>

<h1> Les attractions disponibles à partir de votre taille ! </h1>

<form action = "index.php" method="get">
    <p> <input type="hidden" name="controller" value="attractions"/>     <input type="hidden" name="action" value="attraction"/>
    </p>
    <p> <label> Taille : </label><input type="number" name="taille"></p>
    <p>  <input type="submit" value="Envoyer"/> </p>
</form>

<?php require "view_end.php"; ?>
