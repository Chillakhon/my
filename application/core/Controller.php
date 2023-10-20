<?php

namespace application\core;

use application\models\Admin;
use application\models\Main;

abstract class Controller
{
    public $route;
    public $view;
    public $model;
    public $acl;


    public function __construct($route)
    {
        $this->route = $route;
        $this->checkAcl();
        $this->view = new View($route);
        $this->loadModel($route['controller']);
        $this->model = new Main();

    }

    //for autoload models
    public function loadModel($name)
    {
        $path = 'application\\models\\'.ucfirst($name);
        if (class_exists($path)){
            return new $path;
        }
    }

    public function checkAcl()
    {
            if ($this->isAcl('all')) {
                return true;
            } elseif (isset($_SESSION['authorize']['id']) && $this->isAcl('authorize')) {
                return true;
            } elseif (!isset($_SESSION['authorize']['id']) && $this->isAcl('guest')) {
                return true;
            } elseif (isset($_SESSION['admin']) && $this->isAcl('admin')) {
                return true;
            }
        return false;
    }

    public function isAcl($key)
    {
        $this->acl = require "application/acl/".$this->route['controller'].'.php';
            return in_array($this->route['action'], $this->acl[$key]);
    }
}

