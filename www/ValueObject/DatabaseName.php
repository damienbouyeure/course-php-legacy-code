<?php
declare(strict_types=1);

namespace App\ValueObject;


class DatabaseName
{
    private $databaseName;

    public function __construct(string $databaseName)
    {
        $this->databaseName = $databaseName;
    }

    public function toString() : string
    {
        return $this->databaseName;
    }
}