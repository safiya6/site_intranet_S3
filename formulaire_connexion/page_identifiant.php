<?php
session_start();

if (isset($_SESSION['prenom']) && isset($_SESSION['role'])) {
    echo "Bonjour, " . $_SESSION['prenom'] . ". Vous êtes connecté en tant que " . $_SESSION['role'] . ".";
} else {
    echo "Vous n'êtes pas connecté.";
}
?>