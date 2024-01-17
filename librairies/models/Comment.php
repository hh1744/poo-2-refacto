<?php
require_once 'librairies/models/Model.php';

class Comment extends Model
{
    public function find(int $comment_id)
    {
        $query = $this->pdo->prepare('SELECT * FROM comments WHERE id = :id');
        $query->execute(['id' => $comment_id]);
        return $query->fetch();
    }

    public function findAllWithArticle(int $article_id):array
    {
        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        $query->execute(['article_id' => $article_id]);
        return $query->fetchAll();
    }

    public function insert(string $author, string $content, int $article_id):void
    {
        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    }

    public function delete(int $comment_id):void
    {
        $query = $this->pdo->prepare('DELETE FROM comments WHERE id = :id');
        $query->execute(['id' => $comment_id]);
    }
}