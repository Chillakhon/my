<?php
require_once "vendor/autoload.php";

use App\Data\User;
Use App\Data\Books\Books;
Use App\Data\Books\Miss;


$user = new User();
$book = new Books();
$miss = new Miss();

$book->test();