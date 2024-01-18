<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8"/>
		<title>Portail Enseignant</title>
        <link type="text/css" rel="stylesheet" href="Content/css_visualisation.css" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="fonction_test.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
            
	</head>
	<body>
    <header>
        <?php if (session_status() == PHP_SESSION_NONE) {
    // La session n'est pas démarrée, alors on la démarre
    session_start();
} ?>
        <div class="logo-container">
            <img id="logo" src="Content/logo.svg" alt="Logo de l'IUT de Villetaneuse">
            <div id="title">Outils de visualisation</div>
        </div>
        <div class="navigation">
            <ul id="links">
                <li class="link">
                <form action="?controller=page&action=<?=$_SESSION["role"]?> " method="post">
                <button id="ajout"  type="submit">Visualisation</button>
                </form>
                </li>
                <?php if ($_SESSION["role"] != "enseignant" && $_SESSION["role"] != "secrétaire") : ?>
                <li class="link">
                <form action="?controller=add" method="post">
                <button  id="ajout" type="submit">Ajout</button>
                </form>
                </li>   
                <?php endif?>
                <?php if ($_SESSION["role"] == "directeur"||  $_SESSION["role"] == "equipedirection") : ?>
                 <li class="link">
                <form action="?controller=delete" method="post">
                <button  id="ajout" type="submit">supprimer un enseignant</button>
                </form>
                </li>   
                <li class="link">
                <form action="?controller=update" method="post">
                <button  id="ajout" type="submit">Modifier Besoin en Heure</button>
                </form>
                </li>
                <?php endif?>
                <?php if ($_SESSION["role"] != "secrétaire"):?>
                <li class="link"><a href="#">Mes Cours</a></li>
                <?php endif ?>
                <li class="link"><a href="#">Mon Profil</a></li>
            </ul>
            <button id="connexionButton">Connexion</button>
            <button id="modeSwitch">Light Mode</button>
        </div>
    </header>