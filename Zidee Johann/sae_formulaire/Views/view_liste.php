<?php require "view_begin.php"?>
<main>
<table>
    <tr> <th>Titre</th> <th>Genre</th> <th>Durée</th> <th>Année de Sortie</th> <th>Réalisateur</th>  <th class="sansBordure"></th> <th class="sansBordure"></th></tr>

    <?php foreach ($liste as $pn) : ?>
    <tr>
        <td> <?= e($pn['titre']) ?> </td>
        <td> <?= e($pn['genre']) ?> </td>
        <td> <?= e($pn['duree']) ?> </td>
        <td> <?= e($pn['anneesortie']) ?> </td>
        <td> <?= e($pn['realisateur']) ?> </td>
    </tr>
    <?php endforeach ?> 
</table>

<?php require "view_end.php" ?>
