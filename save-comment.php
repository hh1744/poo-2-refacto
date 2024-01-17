<?php
require_once 'librairies/database.php';
require_once 'librairies/utils.php';
require_once 'librairies/models/Comment.php';
require_once 'librairies/models/Article.php';

/**
 * 1. On vérifie que les données ont bien été envoyées en POST
 * D'abord, on récupère les informations à partir du POST
 * Ensuite, on vérifie qu'elles ne sont pas nulles
 */
// On commence par l'author
$author = null;
if (!empty($_POST['author'])) {
    $author = $_POST['author'];
}

// Ensuite le contenu
$content = null;
if (!empty($_POST['content'])) {
    // On fait quand même gaffe à ce que le gars n'essaye pas des balises cheloues dans son commentaire
    $content = htmlspecialchars($_POST['content']);
}

// Enfin l'id de l'article
$article_id = null;
if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
    $article_id = $_POST['article_id'];
}

// Vérification finale des infos envoyées dans le formulaire (donc dans le POST)
// Si il n'y a pas d'auteur OU qu'il n'y a pas de contenu OU qu'il n'y a pas d'identifiant d'article
if (!$author || !$article_id || !$content) {
    die("Votre formulaire a été mal rempli !");
}

$article = (new Article())->find($article_id);

if (!$article) {
    die("Ho ! L'article $article_id n'existe pas boloss !");
}

// 3. Insertion du commentaire
(new Comment())->insert($author, $content, $article_id);

// 4. Redirection vers l'article en question :
redirect('article.php?id=' . $article_id);