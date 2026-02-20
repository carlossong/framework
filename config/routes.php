<?php
declare(strict_types=1);

/**
 * @var \App\Core\Router $router
 */

$router->get('/', [\App\Controllers\HomeController::class, 'index']);

$router->get('/login', [\App\Controllers\AuthController::class, 'showLogin']);
$router->post('/login', [\App\Controllers\AuthController::class, 'login']);

$router->get('/register', [\App\Controllers\AuthController::class, 'showRegister']);
$router->post('/register', [\App\Controllers\AuthController::class, 'register']);

$router->post('/logout', [\App\Controllers\AuthController::class, 'logout']);

$router->get('/dashboard', [\App\Controllers\DashboardController::class, 'index']);
