<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "test";

return new PDO("mysql:host=$servername;dbname=$database",$username,$password);