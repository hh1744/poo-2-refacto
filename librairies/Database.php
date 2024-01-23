<?php

class Database{

    public static function getPDO(): PDO
    {
        $pdo = new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'gedimat', 'gedimat', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        return $pdo;
    }
}