<?php
declare(strict_types=1);

namespace App\ValueObject;

class Password
{
    private $password;

    public function __construct(?string $password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function toString(): string
    {
        return $this->password;
    }

    public function passwordVerify(string $password, string $hashedPassword): bool
    {
        return password_verify($password, $hashedPassword);
    }
}
