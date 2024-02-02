<?php
require_once 'config/config.php';

$dsn = 'mysql:host=' . constant('APP_DB_HOST') . ';charset=utf8';
$username = constant('APP_DB_USER');
$password = constant('APP_DB_PASSWORD');

$options = [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET SESSION sql_mode='STRICT_TRANS_TABLES', NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];


try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->exec('DROP DATABASE IF EXISTS ' . constant('APP_DB_NAME') . ';');
    $pdo->exec('CREATE DATABASE ' . constant('APP_DB_NAME') . ';');
    $pdo->exec('USE '  . constant('APP_DB_NAME') . ';');
    if (
        is_file("db/database.sql") && is_readable("db/database.sql") &&
        is_file('db/fixtures.php') && is_readable('db/fixtures.php'))
    {
        $sql = file_get_contents("db/database.sql");
        $sql = str_replace('dbTest', constant('APP_DB_NAME'), $sql);
        $statement = $pdo->query($sql);
        require_once 'db/fixtures.php';
        echo "Database and tables created successfully";
    } else {
        echo "db/database.sql" . ' file does not exist';
    }
} catch (PDOException $exception) {
    echo $exception->getMessage();
}
