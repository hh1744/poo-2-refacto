<?php
namespace Models;

require_once 'librairies/database.php';

abstract class Model
{
    protected $pdo;
    protected string $table;

    public function __construct()
    {
        $this->pdo = getPDO();
    }

    public function find(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
    }

    public function findAll(?string $order = ""): array
    {
        $sql = "SELECT * FROM {$this->table}";

        if($order) {
            $sql .= " ORDER BY " . $order;
        }

        $resultats = $this->pdo->query($sql);
        return $resultats->fetchAll();
    }
}