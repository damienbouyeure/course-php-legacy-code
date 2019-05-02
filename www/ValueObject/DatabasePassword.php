<?php
declare(strict_types=1);

namespace App\ValueObject;


class DatabasePassword
{
    private $databasePassword;

    public function __construct(string $databasePassword)
    {
        $this->databasePassword = $databasePassword;
    }

    public function toString() : string
    {
        return $this->databasePassword;
    }
}