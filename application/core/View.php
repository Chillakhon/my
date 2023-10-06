<?php

namespace application\core;

class View extends Controller
{
    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route)
    {
       $this->route = $route;
       $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render($title,$vars = [])
    {
        extract($vars);
        if ('application/views/'.$this->path.'.php') {
            ob_start();
            require_once 'application/views/' . $this->path . '.php';
            $content = ob_get_clean();
            require_once "application/views/layouts/" . $this->layout . '.php';
        }else {
            echo 'not view';
        }
    }

    public function redirect($url){
        header('location:'.$url);
        exit();
    }

    public static function errorCode($code)
    {
        http_response_code($code);
        require_once "application/views/errors/" . $code . '.php';
        exit();
    }
}

