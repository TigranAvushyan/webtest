<?php
    $host = '127.0.0.1';
    $db   = 'webtest';
    $user = 'root';
    $pass = '';

    $dsn = "mysql:host=$host;dbname=$db";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $opt);
    } catch (PDOException $e) {
        die('Подключение не удалось: ' . $e->getMessage());
    }

    session_start();


?>