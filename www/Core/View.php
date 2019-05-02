<?php

declare(strict_types=1);

namespace App\Core;

use App\ValueObject\Template;
use App\ValueObject\ViewObject;

final class View
{

    private $view;
    private $template;
    private $data = [];

    public function __construct(ViewObject $view, Template $template )
    {
        $viewPath = "views/" . $view->view() . ".view.php";
        if (file_exists($viewPath)) {
            $this->view = $viewPath;
        } else {
            die("Attention le fichier view n'existe pas " . $viewPath);
        }

        $templatePath = "views/templates/" . $template->template() . ".tpl.php";
        if (file_exists($templatePath)) {
            $this->template = $templatePath;
        } else {
            die("Attention le fichier template n'existe pas " . $templatePath);
        }
    }


    public function addModal(string $modal, array $config)
    {
        $modalPath = "views/modals/" . $modal . ".mod.php";
        if (file_exists($modalPath)) {
            include $modalPath;
        } else {
            die("Attention le fichier modal n'existe pas " . $modalPath);
        }
    }

    public function assign(string $key, array $value)
    {
        $this->data[$key] = $value;
    }


    public function __destruct()
    {
        extract($this->data);
        include $this->template;
    }
}
