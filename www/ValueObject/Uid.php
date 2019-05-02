<?php
declare(strict_types=1);

namespace App\ValueObject;

class Uid
{
    private $uid;
    public function __construct(int $uid)
    {
        $this->uid = $uid;
    }

    public function toInt() : int
    {
        return $this->uid;
    }
}
