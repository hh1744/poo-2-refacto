<?php
require_once 'librairies/database.php';
require_once 'librairies/utils.php';
require_once 'librairies/models/Article.php';

/**
 * 1. Récupération des articles
 */
$articles = (new Article())->findAll();

/**
 * 2. Affichage
 */
$pageTitle = 'Accueil';
render('articles/index', compact('pageTitle', 'articles'));
