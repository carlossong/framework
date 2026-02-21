<?php
declare(strict_types=1);

namespace App\Core;

class Controller
{
    protected function view(string $name, array $data = []): void
    {
        extract($data);
        
        $viewPath = __DIR__ . "/../../resources/views/{$name}.php";
        
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            echo "View [{$name}] not found.";
        }
    }
}
