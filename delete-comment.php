<?php
require_once 'librairies/database.php';
require_once 'librairies/utils.php';

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
$pdo = getPDO();

$query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
$query->execute(['id' => $id]);
if ($query->rowCount() === 0) {
    die("Aucun commentaire n'a l'identifiant $id !");
}

/**
 * 4. Suppression réelle du commentaire
 * On récupère l'identifiant de l'article avant de supprimer le commentaire
 */

$commentaire = $query->fetch();
$article_id = $commentaire['article_id'];

$query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
$query->execute(['id' => $id]);

/**
 * 5. Redirection vers l'article en question
 */
redirect("article.php?id=" . $article_id);