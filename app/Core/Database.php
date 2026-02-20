<?php
declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    public static function connect(): PDO
    {
        if (self::$connection === null) {
            $config = require __DIR__ . '/../../config/database.php';

            try {
                $dsn = $config['connection'] === 'sqlite' 
                    ? "sqlite:{$config['database']}" 
                    : "{$config['connection']}:host={$config['host']};port={$config['port']};dbname={$config['database']}";
                self::$connection = new PDO($dsn, $config['username'], $config['password'], $config['options']);
            } catch (PDOException $e) {
                die("Could not connect to the database. Please check your configuration. Error: " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}
