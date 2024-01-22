<?php

spl_autoload_register(function ($className){
    $className = str_replace('\\',"/", $className);
    $className = 'librairies/'.$className.'.php';
    require_once $className;
});