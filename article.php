<?php
require_once 'librairies/database.php';
require_once 'librairies/utils.php';
require_once 'librairies/models/Comment.php';
require_once 'librairies/models/Article.php';

/**
 * 1. Récupération du param "id" et vérification de celui-ci
 */
// On part du principe qu'on ne possède pas de param "id"
$article_id = null;

// Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $article_id = $_GET['id'];
}

// On peut désormais décider : erreur ou pas ?!
if (!$article_id) {
    die("Vous devez préciser un paramètre `id` dans l'URL !");
}

$article = (new Article())->find($article_id);
$commentaires = (new Comment())->findAllWithArticle($article_id);

/**
 * 5. On affiche
 */
$pageTitle = $article['title'];

/*render('articles/show', [
    'pageTitle'     => $article['title'],
    'article'       => $article,
    'commentaires'  => $commentaires,
    'article_id'    => $article_id
]);*/

render('articles/show', compact('pageTitle','article', 'commentaires', 'article_id'));
