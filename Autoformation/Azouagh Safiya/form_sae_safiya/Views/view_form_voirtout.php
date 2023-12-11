<?php require "view_begin.php" ?>


<h1> base de donnée Films</h1>

<p>
    <table>
    <tr><th>id</th><th>titre</th><th>genre</th><th> année de sortie</th><th> réalisateur</th></tr>
    <?php foreach ($resultat as $r) : ?>
        
    
    <tr><td><?= e($r['idfilm'])?><td><?= e($r['titre'])?></td><td><?= e($r['genre'])?> </td><td> <?= e($r['anneesortie']) ?> </td><td> <?= e($r['realisateur']) ?> </td></tr>
   
    <?php endforeach ?>
   </table> 


<?php require "view_end.php" ?>