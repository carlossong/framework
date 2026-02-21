<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Model;
use App\Models\Role; // Added this import

class User extends Model
{
    protected string $table = 'users';

    public function getRole(int $roleId)
    {
        $sql = "SELECT * FROM roles WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $roleId]);
        return $stmt->fetch();
    }

    public function getPermissions(int $roleId): array
    {
        $roleModel = new Role();
        return $roleModel->getPermissions($roleId);
    }

    public function findByEmail(string $email): array|false
    {
        return $this->where('email', $email);
    }

    public function create(array $data): bool
    {
        return $this->insert([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);
    }
}
