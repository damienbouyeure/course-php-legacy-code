<?php
declare(strict_types=1);

namespace App\ValueObject;

class Email
{
    private $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function Email(): string
    {
        return $this->email;
    }
}
