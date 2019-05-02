<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\View;

final class PagesController
{
    public function defaultAction() : void
    {
        $view = new View("homepage", "back");
        $view->assign("pseudo", "prof");
    }
}
