<?php
require_once 'librairies/models/Model.php';

class Article extends Model
{
    public function findAll(): array
    {
        $resultats = $this->pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
        return $resultats->fetchAll();
    }

    public function find(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM articles WHERE id = :article_id");
        $query->execute(['article_id' => $id]);
        return $query->fetch();
    }

    public function delete(int $id): void
    {
        $query = $this->pdo->prepare('DELETE FROM articles WHERE id = :id');
        $query->execute(['id' => $id]);
    }
}