<?php

declare(strict_types=1);

use App\Core\Routing;


function myAutoloader($class)
{
    $classmap = explode('\\', $class);
    $classPath = "core/" . $classmap[2] . ".php";
    $classModel = "models/" . $classmap[2] . ".php";
    $classForm = "Form/" . $classmap[2] . ".php";
    $classRepo = "Repository/" . $classmap[2] . ".php";
    if (file_exists($classPath)) {
        include $classPath;
    } elseif (file_exists($classModel)) {
        include $classModel;
    } elseif (file_exists($classForm)) {
        include $classForm;
    } elseif (file_exists($classRepo)) {
        include $classRepo;
    }
}

// La fonction myAutoloader est lancé sur la classe appelée n'est pas trouvée
spl_autoload_register("myAutoloader");

// Récupération des paramètres dans l'url - Routing
$slug = explode("?", $_SERVER["REQUEST_URI"])[0];
$routes = Routing::getRoute($slug);
extract($routes);

$container = [];
$container['config'] = require 'config/global.php';
$container += require 'config/di.global.php';

// Vérifie l'existence du fichier et de la classe pour charger le controlleur

if (file_exists($cPath)) {
    include $cPath;


    if (class_exists('App\\Controller\\' . $c)) {
        //instancier dynamiquement le controller
        $cObject = $container['App\\Controller\\' . $c]($container);
        //vérifier que la méthode (l'action) existe
        if (method_exists($cObject, $a)) {
            //appel dynamique de la méthode
            $cObject->$a();
        } else {
            die("La methode " . $a . " n'existe pas");
        }
    } else {
        die("La class controller " . $c . " n'existe pas");
    }
} else {
    die("Le fichier controller " . $c . " n'existe pas");
}
