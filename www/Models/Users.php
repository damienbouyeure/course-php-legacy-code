<?php

declare(strict_types=1);

namespace App\Models;

use App\ValueObject\Email;
use App\ValueObject\Identity;
use App\ValueObject\Password;
use App\ValueObject\Uid;

final class Users
{
    private $uid;
    private $identity;
    private $email;
    private $password;
    private $role;
    private $status;

    public function __construct(Identity $identity, Email $email, Password $password)
    {
        $this->identity = $identity;
        $this->email = $email;
        $this->password = $password;
        $this->role = 1;
        $this->status = 0;
    }

    public function identity(): Identity
    {
        return $this->identity;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function password(): Password
    {
        return $this->password;
    }

    public function role(): int
    {
        return $this->role;
    }

    public function status() : int
    {
        return $this->status;
    }

    public function uid() : uid
    {
        return $this->uid();
    }
}
