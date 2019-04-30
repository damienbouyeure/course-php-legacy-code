<?php

declare(strict_types=1);

namespace App\Core;


interface DbConnectionInterface
{
    public function connect();
}