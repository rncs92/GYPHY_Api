<?php

require 'vendor/autoload.php';

use Giphy\Model\GiphyApi;


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client = new GiphyApi();
$search = $_GET['search'] ?? '';
$limit = $_GET['amount'] ?? 4;
$gif = $client->searchGif($search, $limit);
$trending = $client->showTrending();


$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/trending', [\Giphy\Controllers\Router::class, 'trending']);
    $r->addRoute('GET', '/search', [\Giphy\Controllers\Router::class, 'search']);

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

        echo $response;

        break;
}
