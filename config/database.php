<?php
declare(strict_types=1);

return [
    'connection' => 'sqlite',
    'host' => '127.0.0.1',
    'port' => '3306',
    'database' => __DIR__ . '/../database/database.sqlite',
    'username' => 'root',
    'password' => '',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
];
