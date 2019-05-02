<?php
declare(strict_types=1);

namespace App\ValueObject;


class Driver
{
    private $driver;

    public function __construct(string $driver)
    {
        $this->driver = $driver;
    }

    public function toString() : string
    {
        return $this->driver;
    }
}