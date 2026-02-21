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

    public function dispatch(string $uri, string $requestMethod): mixed
    {
        foreach ($this->routes as $route) {
            // Converte rota como '/users/(\d+)/edit' para uma regex válida
            $pattern = "#^" . $route['uri'] . "$#";
            
            if ($route['method'] === $requestMethod && preg_match($pattern, $uri, $matches)) {
                // Remove the full match from the beginning
                array_shift($matches);

                $action = $route['action'];

                if (is_callable($action)) {
                    return call_user_func_array($action, $matches);
                }

                if (is_array($action)) {
                    [$class, $method] = $action;

                    if (class_exists($class)) {
                        $controller = new $class();
                        if (method_exists($controller, $method)) {
                            return call_user_func_array([$controller, $method], $matches);
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
        echo "{$code} Não Encontrado";
        exit;
    }
}
