<?php
require_once 'librairies/controllers/Article.php';

(new \Controllers\Article())->delete($_GET['id']);
