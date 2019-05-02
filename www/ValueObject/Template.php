<?php
declare(strict_types=1);

namespace App\ValueObject;


class Template
{
    private $template;

    public function __construct(string $template)
    {
        $this->template = $template;
    }

    public function template() : string
    {
        return $this->template;
    }
}