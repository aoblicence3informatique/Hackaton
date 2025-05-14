<?php
// Définition des constantes de base
define('ROOT', dirname(__DIR__));
define('DS', DIRECTORY_SEPARATOR);

// Activation de l'affichage des erreurs en mode développement
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Chargement de l'autoloader de Composer
// require_once ROOT . DS . 'vendor' . DS . 'autoload.php'; // Désactivé temporairement pour éviter l'erreur

// Chargement de la configuration
require_once ROOT . DS . 'Config' . DS . 'config.php';

// Inclusion manuelle du contrôleur HomeController
require_once ROOT . DS . 'Controllers' . DS . 'HomeController.php';

// Démarrage de la session
session_start();

// Routage simple
$url = isset($_GET['url']) ? $_GET['url'] : '';
$url = explode('/', filter_var(trim($url, '/'), FILTER_SANITIZE_URL));

// Contrôleur par défaut
$controller = !empty($url[0]) ? ucfirst($url[0]) : 'Home';
$method = !empty($url[1]) ? $url[1] : 'index';
$params = array_slice($url, 2);

// Ajout des routes pour les signalements
if ($controller === 'Signalement' && in_array($method, ['valider', 'rejeter'])) {
    $signalementController = new Controllers\SignalementController();
    call_user_func_array([$signalementController, $method], $params);
    exit;
}

// Ajout de la route pour l'action store
if ($controller === 'Signalement' && $method === 'store') {
    $signalementController = new Controllers\SignalementController();
    $signalementController->store();
    exit;
}

// Ajout de la route pour l'action login
if ($controller === 'Utilisateur' && $method === 'login') {
    $utilisateurController = new Controllers\UtilisateurController();
    $utilisateurController->login();
    exit;
}

// Ajout de la route pour l'action index des administrateurs
if ($controller === 'Admin' && $method === 'index') {
    $adminController = new Controllers\AdminController();
    $adminController->index();
    exit;
}

// Construction du nom complet du contrôleur
$controllerClass = "Controllers\\{$controller}Controller";

try {
    if (class_exists($controllerClass)) {
        $controller = new $controllerClass();
        if (method_exists($controller, $method)) {
            call_user_func_array([$controller, $method], $params);
        } else {
            throw new Exception("La méthode {$method} n'existe pas dans le contrôleur {$controllerClass}");
        }
    } else {
        throw new Exception("Le contrôleur {$controllerClass} n'existe pas");
    }
} catch (Exception $e) {
    // Gestion basique des erreurs
    echo "Une erreur est survenue : " . $e->getMessage();
}
