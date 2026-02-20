<?php
declare(strict_types=1);

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $uri, array|callable $action): void
    {
        $this->addRoute('GET', $uri, $action);
    }

    public function post(string $uri, array|callable $action): void
    {
        $this->addRoute('POST', $uri, $action);
    }

    private function addRoute(string $method, string $uri, array|callable $action): void
    {
        $this->routes[] = compact('method', 'uri', 'action');
    }

    public function dispatch(string $uri, string $method): mixed
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                $action = $route['action'];

                if (is_callable($action)) {
                    return call_user_func($action);
                }

                if (is_array($action)) {
                    [$class, $method] = $action;

                    if (class_exists($class)) {
                        $controller = new $class();
                        if (method_exists($controller, $method)) {
                            return call_user_func([$controller, $method]);
                        }
                    }
                }
            }
        }

        return $this->abort();
    }

    protected function abort(int $code = 404): void
    {
        http_response_code($code);
        echo "{$code} Not Found";
        exit;
    }
}
