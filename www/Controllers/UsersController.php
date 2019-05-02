<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Validator;
use App\Core\View;
use App\Form\LoginForm;
use App\Form\RegisterForm;
use App\Models\Users;
use App\Repository\UserRepository;
use App\ValueObject\Email;
use App\ValueObject\Identity;
use App\ValueObject\Password;
use App\ValueObject\ViewObject as ViewObject;
use App\ValueObject\Template;

final class UsersController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function defaultAction(): void
    {
        echo "users default";
    }

    public function addAction(): void
    {
        $registerForm = new RegisterForm();
        $form = $registerForm->getRegisterForm();
       $view = new View(new ViewObject("addUser"), new Template("front"));
       $view->assign("form", $form);
    }

    public function saveAction(): void
    {
        $registerForm = new RegisterForm();
        $form = $registerForm->getRegisterForm();
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_" . $method];
        if ($_SERVER['REQUEST_METHOD'] == $method && !empty($data)) {
            $validator = new Validator($form, $data);
            $form["errors"] = $validator->errors;
            if (empty($errors)) {
                $user = new Users(new Identity($data["firstname"], $data["lastname"]), new Email($data["email"]), new Password($data["pwd"]));
                $this->userRepository->save($user);
                $view = new View(new ViewObject("homepage"), new Template("back"));
                $view->assign("pseudo", "prof");

            }
        }
       $view = new View(new ViewObject("addUser"), new Template("front"));
       $view->assign("form", $form);
    }


    public function loginAction(): void
    {
        $loginForm = new LoginForm();
        $form = $loginForm->getLoginForm();

        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_" . $method];
        if ($_SERVER['REQUEST_METHOD'] == $method && !empty($data)) {
            $validator = new Validator($form, $data);
            $form["errors"] = $validator->errors;

            if (empty($errors)) {
                $token = md5(substr(uniqid() . time(), 4, 10) . "mxu(4il");
                // TODO: connexion
            }
        }
       $view = new View(new ViewObject("loginUser"), new Template("front"));
       $view->assign("form", $form);
    }


    public function forgetPasswordAction(): void
    {
       $view = new View(new ViewObject("forgetPasswordUser"),new Template( "front"));
    }
}
