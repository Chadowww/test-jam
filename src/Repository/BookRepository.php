<?php

namespace App\Repository;

use App\Data\FilterData;
use App\Entity\Book;
use App\Service\ConnectionDbService;
use PDO;
use PDOException;

/**
 *  Repository gérant les données de l'entité Book
 */
class BookRepository
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
     * @param int $id
     * @return array
     */
    public function read(int $id): array
    {
        try {
            $sql = "
                SELECT b.id as book_id, b.title, b.publication_date, a.name as author_name, g.gender_name
                FROM book b 
                LEFT JOIN book_gender bg on bg.book_id = b.id 
                INNER JOIN dbTest.author a on b.author_id = a.id
                LEFT JOIN dbTest.gender g on bg.gender_id = g.id
                WHERE b.id = :id";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage());
        }
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        try {
            $sql = "DELETE FROM book WHERE id = :id";
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();
            return true;
        } catch (PDOException $exception) {
            error_log($exception->getMessage());
            throw new PDOException($exception->getMessage());
        }
    }

    /**
     * @return array
     */
    public function list(): array
    {
        try {
            $sql = "
                    SELECT b.id AS book_id, b.title, b.publication_date, a.name AS author_name,
                           a.id AS author_id, 
                           GROUP_CONCAT(DISTINCT g.gender_name SEPARATOR ', ') as genders
                    FROM book b 
                    LEFT JOIN book_gender bg ON bg.book_id = b.id 
                    INNER JOIN author a ON b.author_id = a.id
                    LEFT JOIN gender g ON bg.gender_id = g.id  
                    GROUP BY b.id
                    ORDER BY book_id ASC";
            $statement = $this->pdo->query($sql);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage());
        }
    }

    /**
     * @param FilterData $data
     * @return array
     */
    public function filter(FilterData $data): array
    {
        $whereClauses = [];

//    on créé des clauses where en fonction des données reçues
        if (!empty($data->authors)) {
            $authorIds = array_map(static function($author) {
                return $author->getId();
            }, $data->authors);
            $whereClauses[] = 'a.id IN (' . implode(', ',  $authorIds) . ')';
        }

        if (!empty($data->genders)) {
            $genderIds = array_map(static function($gender) {
                return $gender->getId();
            }, $data->genders);
            $whereClauses[] = 'g.id IN (' . implode(', ',  $genderIds) . ')';
        }

//      on créé la clause where finale ex: "WHERE a.id IN (5, 7, 15, 18, 21) AND g.id IN (11, 14, 19)"
        $whereClause = (!empty($whereClauses)) ? 'WHERE ' . implode(' OR ', $whereClauses) : '';

        try {
            $sql = "
                SELECT b.id AS book_id, b.title, b.publication_date, a.name AS author_name,
                       a.id AS author_id, 
                       GROUP_CONCAT(DISTINCT g.gender_name SEPARATOR ', ') as genders
                FROM book b 
                INNER JOIN book_gender bg ON bg.book_id = b.id 
                INNER JOIN author a ON b.author_id = a.id
                INNER JOIN gender g ON bg.gender_id = g.id 
                $whereClause
                GROUP BY b.id
                ORDER BY b.id ASC";
            $statement = $this->pdo->query($sql);

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage());
        }
    }
}