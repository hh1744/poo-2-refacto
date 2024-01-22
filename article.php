<?php
require_once 'librairies/auoload.php';

(new \Controllers\Article())->show($_GET['id']);
