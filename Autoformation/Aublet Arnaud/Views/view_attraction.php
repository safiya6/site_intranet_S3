<?php require "view_begin.php";?>

<h1> Vos attractions disponibles : </h1>

<table>
    <tr> <th>Nom</th> <th>Taille accompagnée</th> <th>Taille seul</th> <th>Type d'attraction</th></tr>

    <?php foreach ($attractions as $attraction) : ?>
    <tr>
        <td><?= e($attraction['nom']) ?></td>
        <td><?= e($attraction['taille_min_accompagnee']) ?></td>
        <td><?= e($attraction['taille_min_seul']) ?></td>
        <td><?= e($attraction['categorie']) ?></td>
    </tr>
    <?php endforeach ?> 
</table>

<p><a href='index.php'>Retourner sur les tailles.</p>

<?php require "view_end.php"; ?>