<?php

namespace App\Service;

require_once 'config/config.php';

use PDO;

/**
 *  Service de connexion à la base de données
 */
class ConnectionDbService
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     *
     */
    public function __construct()
    {
        $dsn = 'mysql:host=' . constant('APP_DB_HOST') . ';dbname=' . constant('APP_DB_NAME') . ';charset=utf8';

        $options = [
            PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        $this->connection = new PDO($dsn, constant('APP_DB_USER'), constant('APP_DB_PASSWORD'), $options);
    }

    /**
     * @return PDO
     */
    public function connection(): PDO
    {
        return $this->connection;
    }
}
