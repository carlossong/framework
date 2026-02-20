<?php

declare(strict_types=1);

if (!function_exists('component')) {
    function component(string $_component_name, array $_data = []): void
    {
        extract($_data);
        $_viewPath = __DIR__ . "/../views/components/{$_component_name}.php";
        if (file_exists($_viewPath)) {
            require $_viewPath;
        } else {
            echo "Component [{$_component_name}] not found.";
        }
    }
}
