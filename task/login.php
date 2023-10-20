<?php
session_start();
$pdo = require_once "db.php";

$sql = "SELECT id FROM users WHERE username=:username";
$stm = $pdo->prepare($sql);
foreach ($_POST as $key=>$value){
    $stm->bindValue(':'.$key,$value);
}
$stm->execute();
$result = $stm->fetchColumn();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($result)){
        $_SESSION['user_id'] = $result;
        header("Location: game.php");
    }else{
        echo 'У вас нет доступа';
    }

}
