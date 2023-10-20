<?php

namespace application\controllers;

use application\core\Controller;
use application\core\Db;
use application\core\View;
use application\models\Admin;


class AdminController extends Controller
{
    public $adminModel;
    public $route;

    public function __construct($route)
    {
        parent::__construct($route);
        $this->route = $route;
        $this->view->layout = 'admin';
        $this->db = new Db();
        $this->adminModel = new Admin();
    }

    public function loginAction()
    {
        if (isset($_SESSION['admin'])){
            header('location:/admin/add');
        }
        if (!empty($_POST)){
            if (!$this->adminModel->loginValidate($_POST)){
                $this->view->message('success',$this->adminModel->error);
            }
            $_SESSION['admin'] = true;
            $this->view->redirect('admin/add');
        }
            $this->view->render('вход');
    }

    public function logoutAction()
    {
        unset($_SESSION['admin']);
            header('location:/admin/login');
    }

    public function addAction()
    {
        if ($this->checkAcl()){
            if (!empty($_POST)){
                if (!$this->adminModel->postValidate($_POST,$this->route['action'])){
                    $this->view->message('success',$this->adminModel->error);
                }
               $id = $this->adminModel->postAdd('posts',$_POST);
                $this->adminModel->postUploadImage($_FILES['file'],$id);
                $this->view->message('success','Успешно Добавлено');
            }
            $this->view->render('Добавить пост');
        }else{
            View::errorCode('403');
        }
    }

    public function editAction()
    {
        if ($this->checkAcl()){
            if (!empty($_POST)){
                if (!$this->adminModel->postValidate($_POST,$this->route['action'])){
                    $this->view->message('error',$this->adminModel->error);
                }
                $this->view->message('success','Успешно обнавлено');
            }
            $this->view->render('Редоктировать пост');
        }else{
            View::errorCode('403');
        }
    }

    public function deleteAction()
    {
        if ($this->checkAcl()){
            var_dump($this->route['id']);
        }else{
            View::errorCode('403');
        }
    }

    public function postsAction()
    {
        if ($this->checkAcl()){
            $this->view->render('Посты');
        }else{
            View::errorCode('403');
        }
    }


}
