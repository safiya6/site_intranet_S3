<?php
session_start();

require_once "Utils/functions.php";
require_once "Model/model.php";
require_once "Controllers/controller.php";
require_once "Utils/constant.php";

$controllers = ["list"];
$controller_default = "list";

if (isset($_GET['controller']) && in_array($_GET['controller'], $controllers)) {
    $nom_controller = $_GET['controller'];
} else {
    $nom_controller = $controller_default;
}

$nomclasse = 'Controller_' . ucfirst($nom_controller);
$nom_fichier = 'Controllers/' . $nomclasse . '.php';

if (is_readable($nom_fichier)) {
    require_once $nom_fichier;
    $controller = new $nomclasse();

    // Gérer l'action ici
    $action = $_GET['action'] ?? 'default'; // 'default' est un exemple, utilisez votre action par défaut
    $method = 'action_' . $action;
    if(method_exists($controller, $method)) {
        $controller->$method();
    } else {
        die("Error 404: Action not found!");
    }

} else {
    die("Error 404: Controller not found!");
}
?>
