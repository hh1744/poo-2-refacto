<?php
require_once 'librairies/database.php';
require_once 'librairies/utils.php';

/**
 * 1. Récupération des articles
 */
$articles = findAllArticles();

/**
 * 2. Affichage
 */
$pageTitle = 'Accueil';
render('articles/index', compact('pageTitle', 'articles'));
