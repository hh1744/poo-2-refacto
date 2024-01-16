<?php
require_once 'librairies/database.php';
require_once 'librairies/utils.php';

/**
 * 1. Récupération des articles
 */
$pdo = getPDO();

// On utilisera ici la méthode query (pas besoin de préparation car aucune variable n'entre en jeu)
$resultats = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
// On fouille le résultat pour en extraire les données réelles
$articles = $resultats->fetchAll();

/**
 * 2. Affichage
 */
$pageTitle = 'Accueil';
render('articles/index', compact('pageTitle', 'articles'));
