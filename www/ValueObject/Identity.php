<?php
declare(strict_types=1);

namespace App\ValueObject;

class Identity
{
    private $firstName;
    private $lastName;

    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function FirstName(): string
    {
        return $this->firstName;
    }

    public function LastName(): string
    {
        return $this->firstName;
    }
}
