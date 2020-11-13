<?php

use Src\Request;
use Src\Router;
use Src\Session;

spl_autoload_register(function ($class) {
    require_once dirname(__DIR__) . '/' . str_replace('\\', '/', $class) . '.php';
});

Session::start();

$request = Request::getInstance();

$router = new Router();

require_once __DIR__ . '/../App/routes.php';

try {
    $result = $router->match($request->uri());

    $controller = $result['controllerName'];
    $request->addQueryParams($result['params']);

    (new $controller($request))();
} catch (Exception $e) {
    echo $e->getMessage();
}