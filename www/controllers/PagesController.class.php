<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;

class PagesController
{
    public function defaultAction()
    {
        $v = new View("homepage", "back");
        $v->assign("pseudo", "prof");
    }
}
