<?php
declare(strict_types=1);

namespace App\ValueObject;


class ViewObject
{
    private $view;
    public function __construct(string $view)
    {
        $this->view = $view;
    }

    public function view() : string
    {
        return $this->view;
    }
}