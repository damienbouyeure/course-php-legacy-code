<?php

declare(strict_types=1);

namespace App\Core;


use App\Core\DbConnectionInterface;
use Exception;
use PDO;

final class SQLConnect implements DbConnectionInterface
{
    private $pdo;

    public function __construct($driver, $host, $name, $user, $password)
    {

        try {

            $this->pdo = new PDO($driver . ":host=" . $host . ";dbname=" . $name, $user, $password);
            var_dump($this->pdo);
        } catch (Exception $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function connect(): PDO
    {
        return $this->pdo;
    }
}
