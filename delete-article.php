<?php
require_once 'librairies/auoload.php';

(new \Controllers\Article())->delete($_GET['id']);
