<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;

$db = Database::connect();

$sql = "ALTER TABLE users ADD COLUMN role TEXT DEFAULT 'user' NOT NULL";

try {
    $db->exec($sql);
    echo "Column 'role' added to 'users' table successfully.\n";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'duplicate column name') !== false) {
        echo "Column 'role' already exists.\n";
    } else {
        echo "Error modifying table: " . $e->getMessage() . "\n";
    }
}
