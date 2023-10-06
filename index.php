<?php
session_start();

spl_autoload_register(function ($class)
{
    $path = str_replace('\\','/',$class).'.php';
    if (file_exists($path)) {
        require_once $path;
    }

});

use application\core\Router;

$router = new Router();

$router->run();
