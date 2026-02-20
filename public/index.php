<?php
declare(strict_types=1);

// Session timeout (10 minutes = 600 seconds)
ini_set('session.gc_maxlifetime', '600');
session_set_cookie_params(['lifetime' => 600]);

session_start();

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 600)) {
    session_unset();
    session_destroy();
    session_start();
}
$_SESSION['last_activity'] = time();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/helpers.php';

use App\Core\Router;

$router = new Router();

require __DIR__ . '/../config/routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($uri, $method);
