<?php require "view_begin.php"; ?>

<h1>Liste des Films</h1>

<ul>
<?php foreach($films as $film): ?>
    <li>
        <?= htmlspecialchars($film['titre']) ?> (<?= htmlspecialchars($film['anneesortie']) ?>)
    </li>
<?php endforeach; ?>
</ul>

<?php require "view_end.php"; ?>
