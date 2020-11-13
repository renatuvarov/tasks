<?php

use App\Controllers\CreateTaskController;
use App\Controllers\MainController;
use App\Controllers\LoginController;
use App\Controllers\LogoutController;
use App\Controllers\UpdateTaskController;

/**
 * @var \Src\Router $router
 */

$router->add('/', MainController::class);
$router->add('/login', LoginController::class);
$router->add('/logout', LogoutController::class);
$router->add('/create', CreateTaskController::class);
$router->add('/update/(?<id>\d+)', UpdateTaskController::class);
