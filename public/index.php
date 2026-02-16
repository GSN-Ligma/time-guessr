<?php

/**
 * home page
 * 
 */
session_start();
$page = $_GET['page'] ?? 'home';

// 2. Définition des routes autorisées (Nom dans l'URL => Chemin du fichier)
$routes = [
    'home'          => '../src/views/home.php',
    'round'         => '../src/views/round.php',
    'round-results' => '../src/views/round-results.php',
    'game-over'     => '../src/views/game-over.php',
];

require_once $routes[$page];
?>
