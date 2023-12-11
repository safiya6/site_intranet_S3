<?php require "view_begin.php" ?>



<h1> Supprimer un film </br> en selectionant son id </h1>

<form action = "?controller=crud&action=delete" method="post" onsubmit = "return confirmerSuppression();">
    
    <p> <label> id: <input type="text" name="id"/> </label></p>



    <p>  <input type="submit" value="Supprimer dans la base de donnée"/> </p>
</form>
<script> function confirmerSuppression() {
    return confirm ("êtes-vous sur de vouloir supprimer cette ligne");
} 
    </script>




<?php require "view_end.php" ?>