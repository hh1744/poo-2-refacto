<?php
require_once 'librairies/database.php';
require_once 'librairies/utils.php';
require_once 'librairies/models/Comment.php';

/**
 * 1. Récupération du paramètre "id" en GET
 */
if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ! Fallait préciser le paramètre id en GET !");
}

$id = $_GET['id'];

/**
 * 3. Vérification de l'existence du commentaire
 */
$commentModel = new Comment();
$commentaire = $commentModel->find($id);

if (!$commentaire) {
    die("Aucun commentaire n'a l'identifiant $id !");
}

/**
 * 4. Suppression réelle du commentaire
 * On récupère l'identifiant de l'article avant de supprimer le commentaire
 */
$article_id = $commentaire['article_id'];
$commentModel->delete($id);

/**
 * 5. Redirection vers l'article en question
 */
redirect("article.php?id=" . $article_id);