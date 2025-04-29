<?php

session_start();

$DB_HOST = '127.0.0.1';
$DB_NAME = 'redbird_eats';
$DB_USER = 'root';
$DB_PASS = '';



try {
    $pdo = new PDO(
        "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4",
        $DB_USER,
        $DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

} catch (Exception $e){
    die('Database connection failed: ' . $e->getMessage());
}
?>