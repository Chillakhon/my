<?php

namespace application\controllers;

use application\core\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $this->view->render('Главная страница');
    }

    public function contactAction()
    {
        if (!empty($_POST)){
            if (!$this->model->contactValidate($_POST)){
                $this->view->message('error',$this->model->error);
            }
            mail('jihikox311@gronasu.com','Сообщение от блога' , $_POST['name'] . '/'. $_POST['email'] .'/'.$_POST['text']);
            $this->view->message('success','Сообщение отправлено Администратору.');
        }
        $this->view->render('Контакты');
    }

    public function aboutAction()
    {
        $this->view->render('Обо мне');
    }

    public function postAction()
    {
        $this->view->render('Пост');
    }
}
