<?php

namespace application\models;

use application\core\Model;

class Admin extends Model
{
    public $error;

    public function loginValidate($post)
    {
        $config = require_once "application/config/admin.php";
        if ($config['login'] != $post['login'] or $config['password'] != $post['password']){
            $this->error = 'Логен или пароль указон неверно';
            return false;
        }
        return true;
    }

    public function postValidate($post,$type)
    {
        $nameLen = strlen($post['name']);
        $textLen = iconv_strlen($post['text']);
        $descriptionLen = iconv_strlen($post['description']);
        if ($nameLen < 3 or $nameLen >25){
            $this->error = 'Название должно содержать от 3 до 25 символов';
            return false;
        }elseif ($descriptionLen < 5 or $descriptionLen > 200){
            $this->error = 'Описание должно содержать от 5 до 100 символов';
            return false;
        }elseif ($textLen < 10 or $textLen > 200){
            $this->error = 'Текст должно содержать от 10 до 200 символов';
            return false;
        }
        if (empty($_FILES['file']['tmp_name']) && $type == 'add'){
            $this->error = 'Изоброжение не выбрано';
            return false;
        }
        return true;
    }

    public function postAdd($nameTable,$data)
    {
        $keys = implode(',', array_keys($data));
        $valuesKeys = ":" . implode(', :', array_keys($data));
        $sql = "INSERT INTO $nameTable ({$keys}) VALUES ({$valuesKeys})";
        $stm = $this->pdo->prepare($sql);
        foreach ($data as $key=>$val) {
            $stm->bindValue(':'.$key,$val);
        }
        $stm->execute();
        return $this->pdo->lastInsertId();
    }


    public function postUploadImage($image,$id)
    {
         move_uploaded_file($image['tmp_name'],'application/uploads/'.$id.$image['name']);
        /*$images = $image['tmp_name'];
        $img = new Imagick("$images");
        $img->setImageCompressionQuality(80);
        $img->writeImage('application/uploads/'.$id.$image['name']);*/

    }

    public function isPostExists($id)
    {
        $params = ['id'=>$id];
        return $this->column('SELECT id FROM posts WHERE id=:id',$params);
    }
}
