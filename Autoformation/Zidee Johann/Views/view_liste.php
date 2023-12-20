<?php require "view_beginListe.php"?>

        <main>
            <table>
                <tr> <th>Id du Film</th> <th>Titre</th> <th>Genre</th> <th>Durée</th> <th>Année de Sortie</th> <th>Réalisateur</th>  <th class="sansBordure"></th> <th class="sansBordure"></th></tr>

                <?php foreach ($liste as $pn) : ?>
                <tr>
                    <td> <?= e($pn['idfilm']) ?> </td>
                    <td> <?= e($pn['titre']) ?> </td>
                    <td> <?= e($pn['genre']) ?> </td>
                    <td> <?= e($pn['duree']) ?> </td>
                    <td> <?= e($pn['anneesortie']) ?> </td>
                    <td> <?= e($pn['realisateur']) ?> </td>
                </tr>
                <?php endforeach ?> 
            </table>
        </main>

<?php require "view_end.php" ?>
