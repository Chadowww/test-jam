<?php

namespace App\Repository;

use App\Entity\Author;
Use PDO;
use App\Service\ConnectionDbService;
use PDOException;

/**
 *  Repository gérant les données de l'entité Author
 */
class AuthorRepository
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @param ConnectionDbService $connectionDbService
     */
    public function __construct(ConnectionDbService $connectionDbService)
    {
        $this->pdo = $connectionDbService->connection();
    }

    /**
     * @param $id
     * @return Author
     */
    public function read($id): Author
    {
        try {
            $sql = "SELECT * FROM author WHERE id = :id";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([
                'id' => $id
            ]);

            return $statement->fetchObject(Author::class);
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage());
        }
    }

    /**
     * @return array
     */
    public function list(): array
    {
       try
       {
           $sql = "SELECT DISTINCT author.* 
                FROM author 
                INNER JOIN book b on author.id = b.author_id
                INNER JOIN book_gender bg on b.id = bg.book_id
                ORDER BY author.name ASC";
           $statement = $this->pdo->prepare($sql);
           $statement->execute();

           return $statement->fetchAll(PDO::FETCH_CLASS, Author::class);
       } catch (PDOException $exception) {
           throw new PDOException($exception->getMessage());
       }
    }
}