<?php

declare(strict_types=1);

if (!function_exists('component')) {
    function component(string $_component_name, array $_data = []): void
    {
        extract($_data);
        $_viewPath = __DIR__ . "/../resources/views/components/{$_component_name}.php";
        if (file_exists($_viewPath)) {
            require $_viewPath;
        } else {
            echo "Componente [{$_component_name}] não encontrado.";
        }
    }
}

if (!function_exists('is_admin')) {
    function is_admin(): bool
    {
        return isset($_SESSION['role_name']) && strtolower($_SESSION['role_name']) === 'admin';
    }
}

if (!function_exists('has_permission')) {
    function has_permission(string $permissionName): bool
    {
        return isset($_SESSION['permissions']) && in_array($permissionName, $_SESSION['permissions'], true);
    }
}
