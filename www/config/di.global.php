<?php
declare(strict_types=1);

use App\Controller\PagesController;
use App\Core\DbConnectionInterface;
use App\Repository\UserRepository;
use App\Controller\UsersController;
use App\Models\Users;
use App\Core\SQLConnect;
use App\ValueObject\DatabaseName;
use App\ValueObject\DatabasePassword;
use App\ValueObject\DatabaseUser;
use App\ValueObject\Driver;
use App\ValueObject\Host;

return [
    DbConnectionInterface::class => function ($container) {
        $host = $container['config']['database']['host'];
        $driver = $container['config']['database']['driver'];
        $name = $container['config']['database']['name'];
        $user = $container['config']['database']['user'];
        $password = $container['config']['database']['password'];
        return new SQLConnect(new Driver($driver), new Host($host), new DatabaseName($name), new DatabaseUser($user), new DatabasePassword($password));
    },
    UsersController::class => function ($container) {
        $userRepository = $container [UserRepository::class]($container);
        return new UsersController($userRepository);
    },
    PagesController::class => function ($container) {
        return new PagesController();
    },
    UserRepository::class => function ($container) {
        $SQLConnect = $container [DbConnectionInterface::class]($container);
        return new UserRepository($SQLConnect);
    }
];
