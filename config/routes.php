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

// User CRUD Routes
$router->get('/users', [\App\Controllers\UserController::class, 'index']);
$router->get('/users/create', [\App\Controllers\UserController::class, 'create']);
$router->post('/users/create', [\App\Controllers\UserController::class, 'store']);
$router->get('/users/(\d+)/edit', [\App\Controllers\UserController::class, 'edit']);
$router->post('/users/(\d+)/edit', [\App\Controllers\UserController::class, 'update']);
$router->post('/users/(\d+)/delete', [\App\Controllers\UserController::class, 'destroy']);

// Roles CRUD routes
$router->get('/roles', [\App\Controllers\RoleController::class, 'index']);
$router->get('/roles/create', [\App\Controllers\RoleController::class, 'create']);
$router->post('/roles/create', [\App\Controllers\RoleController::class, 'store']);
$router->get('/roles/(\d+)/edit', [\App\Controllers\RoleController::class, 'edit']);
$router->post('/roles/(\d+)/edit', [\App\Controllers\RoleController::class, 'update']);
$router->post('/roles/(\d+)/delete', [\App\Controllers\RoleController::class, 'destroy']);

// Permissions CRUD routes
$router->get('/permissions', [\App\Controllers\PermissionController::class, 'index']);
$router->get('/permissions/create', [\App\Controllers\PermissionController::class, 'create']);
$router->post('/permissions/create', [\App\Controllers\PermissionController::class, 'store']);
$router->get('/permissions/(\d+)/edit', [\App\Controllers\PermissionController::class, 'edit']);
$router->post('/permissions/(\d+)/edit', [\App\Controllers\PermissionController::class, 'update']);
$router->post('/permissions/(\d+)/delete', [\App\Controllers\PermissionController::class, 'destroy']);
