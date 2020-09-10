<?php
require_once __DIR__.'/vendor/autoload.php';

use Klein\App;
use Klein\Klein;
use Klein\Request;
use Klein\Response;
use Klein\ServiceProvider;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$router = new Klein();

$router->respond(function (Request $request, Response $response, ServiceProvider $service, App $app) use ($router) {
    $app->register('twig', function () {
        $loader = new FilesystemLoader("templates");
        return new Environment($loader, ["debug" => true]);
    });
});

$router->respond('GET', '/', function (Request $request, Response $response, ServiceProvider $service, App $app) {
    return $app->twig->render('home.html.twig',[]);
});

$router->dispatch();