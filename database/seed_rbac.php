<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;

$db = Database::connect();

$db->beginTransaction();

try {
    // Clear out
    $db->exec("DELETE FROM role_permissions");
    $db->exec("DELETE FROM permissions");
    $db->exec("DELETE FROM users");
    $db->exec("DELETE FROM roles");

    // Seed Roles
    $db->exec("INSERT INTO roles (id, name, description) VALUES (1, 'Admin', 'Full access to system')");
    $db->exec("INSERT INTO roles (id, name, description) VALUES (2, 'User', 'Standard user access')");

    // Seed Permissions
    $db->exec("INSERT INTO permissions (id, name, description) VALUES (1, 'manage_users', 'Can create, edit, delete users')");
    $db->exec("INSERT INTO permissions (id, name, description) VALUES (2, 'manage_roles', 'Can create, edit, delete roles and permissions')");

    // Assign Permissions to Admin Role
    $db->exec("INSERT INTO role_permissions (role_id, permission_id) VALUES (1, 1)");
    $db->exec("INSERT INTO role_permissions (role_id, permission_id) VALUES (1, 2)");

    // Seed Admin User
    $password = password_hash('Master10', PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO users (name, email, password, role_id) VALUES ('Admin', 'admin@admin.com', :pw, 1)");
    $stmt->execute(['pw' => $password]);

    $db->commit();
    echo "Seed data inserted successfully.\n";

} catch (PDOException $e) {
    $db->rollBack();
    echo "Error seeding: " . $e->getMessage() . "\n";
}
