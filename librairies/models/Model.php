<?php
require_once 'librairies/database.php';

class Model
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = getPDO();
    }
}