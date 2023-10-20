<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $row = $_POST["row"];
    $col = $_POST["col"];
    $player = $_POST["player"];


    $_SESSION["box"][$row][$col] = $player;

    include "box.php";
}
