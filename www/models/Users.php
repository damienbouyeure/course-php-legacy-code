<?php

declare(strict_types=1);

namespace App\Models;


final class Users
{
    public $id = null;
    public $firstname;
    public $lastname;
    public $email;
    public $pwd;
    public $role = 1;
    public $status = 0;

    public function setFirstname(string $firstname)
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    public function setLastname(string $lastname)
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    public function setEmail(string $email)
    {
        $this->email = strtolower(trim($email));
    }

    public function setPwd(string $pwd)
    {
        $this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
    }

    public function setRole(string $role)
    {
        $this->role = $role;
    }

    public function setStatus(string $status)
    {
        $this->status = $status;
    }
}
