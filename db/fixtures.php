<?php

require_once 'config/config.php';

$db = null;
$dsn = 'mysql:host=' . constant('APP_DB_HOST') . ';dbname=' . constant('APP_DB_NAME') . ';charset=utf8';
$username = constant('APP_DB_USER');
$password = constant('APP_DB_PASSWORD');
$options = [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET SESSION sql_mode='STRICT_TRANS_TABLES', NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];

try {
    $db = new PDO($dsn, $username, $password, $options);
    echo "Connected successfully\n";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

function addAuthor(PDO $db)
{
    try {
        for ($i = 1; $i <= 10 ; $i++) {
            $sql = "INSERT INTO author (id, name) VALUES (:id, :name) ON DUPLICATE KEY UPDATE id = :id, name = :name";
            $statement = $db->prepare($sql);
            $statement->bindValue(':id', $i);
            $statement->bindValue(':name', "author" . $i);
            $statement->execute();
        }
        echo "Authors inserted successfully\n";
    } catch (PDOException $e) {
        echo "Authors inserted failed : " . $e->getMessage();
        die();
    }
}

function addBook(PDO $db)
{
    try {
        for ($i = 1; $i <= 20 ; $i++) {
            $sql = "INSERT INTO book (id,title,publication_date, author_id) VALUES (:id, :title, :publication_date, :author_id) ON DUPLICATE KEY UPDATE id = :id,title = :title, publication_date = :publication_date, author_id = :author_id";
            $statement = $db->prepare($sql);
            $statement->bindValue(':id', $i);
            $statement->bindValue(':title', "title" . $i);
            $statement->bindValue(':publication_date', "2021-01-01");
            $statement->bindValue(':author_id', random_int(1, 10));
            $statement->execute();
        }
        echo "Books inserted successfully\n";
    } catch (PDOException $e) {
        echo "Books inserted failed :" . $e->getMessage();
        die();
    }
}

function addGender(PDO $db)
{
    try {
        for ($i = 1; $i <= 10 ; $i++) {
            $sql = "INSERT INTO gender (id, gender_name) VALUES (:id, :gender_name) ON DUPLICATE KEY UPDATE id = :id, gender_name = :gender_name";
            $statement = $db->prepare($sql);
            $statement->bindValue(':id', $i);
            $statement->bindValue(':gender_name', "gender" . $i);
            $statement->execute();
        }
        echo "Gender inserted successfully\n";
    } catch (PDOException $e) {
        echo "Gender inserted failed :" . $e->getMessage();
        die();
    }
}

function addBookGender(PDO $db)
{
    try {
        for ($i = 1; $i <= 20; $i++) {
            $sql = "INSERT INTO book_gender (id, book_id, gender_id) VALUES (:id, :book_id, :gender_id) ON DUPLICATE KEY UPDATE id =:id, book_id = :book_id, gender_id = :gender_id";
            $statement = $db->prepare($sql);
            $statement->bindValue(':id', $i);
            $statement->bindValue(':book_id', random_int(1, 20));
            $statement->bindValue(':gender_id', random_int(1, 10));
            $statement->execute();
        }
        echo "Gender_Book inserted successfully\n";
    } catch (PDOException $e) {
        echo "Gender_Book inserted failed : " . $e->getMessage();
        die();
    }
}


    addAuthor($db);
    addBook($db);
    addGender($db);
    addBookgender($db);
    echo "Data inserted successfully\n";
