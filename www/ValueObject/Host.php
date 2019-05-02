<?php
declare(strict_types=1);

namespace App\ValueObject;


class Host
{
    private $host;

    public function __construct(string $host)
    {
        $this->host = $host;
    }

    public function toString() : string
    {
        return $this->host;
    }
}