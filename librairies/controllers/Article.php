<?php
namespace Controllers;

require_once 'librairies/utils.php';
require_once 'librairies/models/Article.php';
require_once 'librairies/models/Comment.php';
require_once 'librairies/controllers/Controller.php';

class Article extends Controller
{
    protected $modelName = \Models\Article::class;

    public function index(): void
    {
        $articles = $this->model->findAll("created_at DESC");

        $pageTitle = 'Accueil';
        render('articles/index', compact('pageTitle', 'articles'));
    }

    public function show(int $id): void
    {
        if (!empty($id)) {
            $article_id = $id;
        }

        $article = $this->model->find($id);
        $commentaires = (new \Models\Comment())->findAllWithArticle($id);
        $pageTitle = $article['title'];

        render('articles/show', compact('pageTitle','article', 'commentaires', 'article_id'));
    }

    public function delete(int $id): void
    {
        if (empty($id)) {
            die("Ho ?! Tu n'as pas précisé l'id de l'article !");
        }

        $article = $this->model->find($id);

        if (!$article) {
            die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
        }

        $this->model->delete($id);

        redirect("index.php");
    }
}