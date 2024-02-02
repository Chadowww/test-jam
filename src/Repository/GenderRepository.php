<?php

namespace App\Repository;
use App\Entity\Gender;
use App\Service\ConnectionDbService;
use PDO;
use PDOException;

/**
 * Repository gérant les données de l'entité Gender
 */
class GenderRepository
{

    /**
     * @param ConnectionDbService $connectionDbService
     */
    public function __construct(ConnectionDbService $connectionDbService)
    {
        $this->pdo = $connectionDbService->connection();
    }

    /**
     * @param $id
     * @return Gender
     */
    public function read($id): Gender
    {
       try {
           $sql ="SELECT * FROM gender WHERE id = :id";
           $statement = $this->pdo->prepare($sql);
           $statement->execute([
               'id' => $id
           ]);
           $gender = $statement->fetchObject(Gender::class);

           return $gender;
       } catch (PDOException $exception) {
           throw new PDOException($exception->getMessage());
       }
    }

    /**
     * @return array
     */
    public function list() : array
    {
       try {
           $sql = "SELECT DISTINCT gender.* FROM gender RIGHT JOIN book_gender bg on gender.id = bg.gender_id";
           $statement = $this->pdo->prepare($sql);
           $statement->execute();
           $genders = $statement->fetchAll(PDO::FETCH_CLASS, Gender::class);

           return $genders;
       } catch (PDOException $exception) {
           throw new PDOException($exception->getMessage());
       }
    }
}