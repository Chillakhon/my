<?php

namespace application\core;

use PDO;

class Db
{
    protected $pdo;

    public function __construct()
    {
        $config = require_once "application/lib/Db.php";

           // $this->pdo = new PDO("mysql:host=".$config['host'].";dbname=".$config['dbname']."",$config['username'],$config['password']);
            $this->pdo = new PDO("mysql:host=localhost;dbname=test",'root','root');
    }

    public function query($sql,$params = [])
    {
        $stm = $this->pdo->prepare($sql);
        foreach ($params as $key=>$value){
            $stm->bindValue(':'.$key,$value);
        }
        $stm->execute();
        return $stm;
    }

    public function row($sql,$params = [])
    {
        $result = $this->query($sql,$params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql,$params = [])
    {
        $result = $this->query($sql,$params);
        return $result->fetchColumn();
    }

}



