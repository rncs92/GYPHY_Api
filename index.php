<?php

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$search = $_GET['search'] ?? '';
$limit = $_GET['amount'] ?? 4;

$loader = new Twig\Loader\FilesystemLoader('app/View');
$twig = new Twig\Environment($loader);


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', [\Giphy\Controllers\Router::class, 'search']);
    $r->addRoute('GET', '/trending', [\Giphy\Controllers\Router::class, 'trending']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // ... call $handler with $vars

        [$controllerName, $methodName] = $handler;
        $controller = new $controllerName;
        $response = $controller->{$methodName}();

        echo $twig->render('trending.twig', ['gifs' => $response]);
        break;
}
