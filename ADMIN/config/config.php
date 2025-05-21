<?php
    // $host = 'pg';
    // $db = 'studs';
    // $user = 's345124';
    // $password = 'qm0ghr6oVu3vPs8J';
    // $dsn = "pgsql:host=$host;port=5432;dbname=$db;";
    // $conn = new PDO($dsn, $user, $password);
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dsn = "mysql:host=localhost;dbname=website_shopdemo";
    $user = "root";
    $password = ""; 
    $conn = new PDO($dsn, $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>