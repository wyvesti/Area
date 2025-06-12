<?php

namespace App\Repository;

class Database
{
    public static function connect(): \PDO
    {
        return new \PDO(
            "mysql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_NAME'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD']
        );
    }
}
