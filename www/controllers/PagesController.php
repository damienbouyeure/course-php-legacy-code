<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;

final class PagesController
{
    public function defaultAction() : void
    {
        $v = new View("homepage", "back");
        $v->assign("pseudo", "prof");
    }
}
