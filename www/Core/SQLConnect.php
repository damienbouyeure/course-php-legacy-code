<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\DbConnectionInterface;
use App\ValueObject\DatabaseName;
use App\ValueObject\DatabasePassword;
use App\ValueObject\DatabaseUser;
use App\ValueObject\Driver;
use App\ValueObject\Host;
use Exception;
use PDO;

final class SQLConnect implements DbConnectionInterface
{
    private $pdo;

    public function __construct(Driver $driver, Host $host, DatabaseName $databaseName, DatabaseUser $databaseUser, DatabasePassword $databasePassword)
    {
        try {
            $this->pdo = new PDO($driver->toString() . ":host=" . $host->toString() . ";dbname=" . $databaseName->toString(), $databaseUser->toString(), $databasePassword->toString());
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function connect(): PDO
    {
        return $this->pdo;
    }
}
