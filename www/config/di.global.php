<?php

use App\Controller\PagesController;
use App\Repository\UserRepository;
use App\Controller\UsersController;
use App\Models\Users;
use App\Core\SQLConnect;

return [
    SQLConnect::class => function ($container) {
        $host = $container['config']['database']['host'];
        $driver = $container['config']['database']['driver'];
        $name = $container['config']['database']['name'];
        $user = $container['config']['database']['user'];
        $password = $container['config']['database']['password'];
        return new SQLConnect($driver, $host, $name, $user, $password);
    },
    UsersController::class => function ($container) {
        $userRepository = $container [UserRepository::class]($container);
        return new UsersController($userRepository);
    },
    PagesController::class => function ($container) {
        return new PagesController();
    },
    UserRepository::class => function ($container) {
        $baseSQL = $container [SQLConnect::class]($container);
        return new UserRepository($baseSQL);
    }
];