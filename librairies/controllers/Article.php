<?php
namespace Controllers;

class Article extends Controller
{
    protected $modelName = \Models\Article::class;

    public function index(): void
    {
        $articles = $this->model->findAll("created_at DESC");

        $pageTitle = 'Accueil';
        \Renderer::render('articles/index', compact('pageTitle', 'articles'));
    }

    public function show(): void
    {
        if (!empty($_GET['id'])) {
            $article_id = $_GET['id'];
        }

        $article = $this->model->find($_GET['id']);
        $commentaires = (new \Models\Comment())->findAllWithArticle($_GET['id']);
        $pageTitle = $article['title'];

        \Renderer::render('articles/show', compact('pageTitle','article', 'commentaires', 'article_id'));
    }

    public function delete(): void
    {
        if (empty($_GET['id'])) {
            die("Ho ?! Tu n'as pas précisé l'id de l'article !");
        }

        $article = $this->model->find($_GET['id']);

        if (!$article) {
            die("L'article " . $_GET['id'] . " n'existe pas, vous ne pouvez donc pas le supprimer !");
        }

        $this->model->delete($_GET['id']);

        \Http::redirect("index.php");
    }
}