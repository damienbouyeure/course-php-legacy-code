<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Validator;
use App\Core\View;
use App\Form\LoginForm;
use App\Form\RegisterForm;
use App\Models\Users;
use App\Repository\UserRepository;


final class UsersController
{
    private $user;
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->user = new Users();
    }

    public function defaultAction(): void
    {
        echo "users default";
    }

    public function addAction(): void
    {
        $registerForm = new RegisterForm();
        $form = $registerForm->getRegisterForm();
        $v = new View("addUser", "front");
        $v->assign("form", $form);
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
                $this->user->setFirstname($data["firstname"]);
                $this->user->setLastname($data["lastname"]);
                $this->user->setEmail($data["email"]);
                $this->user->setPwd($data["pwd"]);
                $this->userRepository->save($this->user);
            }
        }
        $v = new View("addUser", "front");
        $v->assign("form", $form);
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
        $v = new View("loginUser", "front");
        $v->assign("form", $form);
    }


    public function forgetPasswordAction(): void
    {
        $v = new View("forgetPasswordUser", "front");
    }
}
