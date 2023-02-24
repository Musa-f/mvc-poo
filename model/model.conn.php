<?php

function conn() {
    $host = 'localhost';
    $dbname = 'tp-poo';
    $username = 'root';
    $password = '';
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    return $conn;
}

?>
