<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Film</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            width: 300px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h2>Ajouter un Film</h2>

    <form action="ajouter_film.php" method="post">
        <label for="titre">Titre du Film:</label>
        <input type="text" id="titre" name="titre" required>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required>

        <label for="duree">Durée (en minutes):</label>
        <input type="number" id="duree" name="duree" required>

        <label for="annee_sortie">Année de Sortie:</label>
        <input type="number" id="annee_sortie" name="annee_sortie" required>

        <label for="realisateur">Réalisateur:</label>
        <input type="text" id="realisateur" name="realisateur" required>

        <input type="submit" value="Ajouter le Film">
    </form>

</body>
</html>
        