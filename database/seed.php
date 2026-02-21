<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;

$db = Database::connect();

$name = 'Admin';
$email = 'admin@admin.com';
$password = password_hash('Master10', PASSWORD_DEFAULT);
$role = 'admin';

$sql = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
$stmt = $db->prepare($sql);
$stmt->execute([
    'name' => $name,
    'email' => $email,
    'password' => $password,
    'role' => $role
]);

echo "Database seeded with user: $email\n";
