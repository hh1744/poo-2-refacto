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

    public function show(int $id): void
    {
        if (!empty($id)) {
            $article_id = $id;
        }

        $article = $this->model->find($id);
        $commentaires = (new \Models\Comment())->findAllWithArticle($id);
        $pageTitle = $article['title'];

        \Renderer::render('articles/show', compact('pageTitle','article', 'commentaires', 'article_id'));
    }

    public function delete(int $id): void
    {
        if (empty($id)) {
            die("Ho ?! Tu n'as pas pr�cis� l'id de l'article !");
        }

        $article = $this->model->find($id);

        if (!$article) {
            die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
        }

        $this->model->delete($id);

        \Http::redirect("index.php");
    }
}