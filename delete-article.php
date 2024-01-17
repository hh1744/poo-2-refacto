<?php
require_once 'librairies/database.php';
require_once 'librairies/utils.php';
require_once 'librairies/models/Article.php';

/**
 * 1. On vérifie que le GET possède bien un paramètre "id" (delete.php?id=202) et que c'est bien un nombre
 */
if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ?! Tu n'as pas précisé l'id de l'article !");
}

$id = $_GET['id'];

$article = (new Article())->find($id);
if (!$article) {
    die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
}

/**
 * 4. Réelle suppression de l'article
 */
(new Article())->delete($id);

/**
 * 5. Redirection vers la page d'accueil
 */
redirect("index.php");
