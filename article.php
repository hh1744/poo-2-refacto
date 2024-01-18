<?php
require_once 'librairies/controllers/Article.php';

(new \Controllers\Article())->show($_GET['id']);
