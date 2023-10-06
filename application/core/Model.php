<?php

namespace application\core;


abstract class Model
{
    public $db;

    public function __Construct()
    {
        $this->db = new Db();
    }
}
