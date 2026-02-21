<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Role extends Model
{
    protected string $table = 'roles';

    public function getPermissions(int $roleId): array
    {
        $sql = "SELECT p.* FROM permissions p 
                JOIN role_permissions rp ON p.id = rp.permission_id 
                WHERE rp.role_id = :role_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['role_id' => $roleId]);
        return $stmt->fetchAll();
    }

    public function syncPermissions(int $roleId, array $permissionIds): void
    {
        // Remove existing
        $stmt = $this->db->prepare("DELETE FROM role_permissions WHERE role_id = :role_id");
        $stmt->execute(['role_id' => $roleId]);

        // Insert new ones
        if (!empty($permissionIds)) {
            $sql = "INSERT INTO role_permissions (role_id, permission_id) VALUES (:role_id, :permission_id)";
            $stmt = $this->db->prepare($sql);
            foreach ($permissionIds as $pId) {
                $stmt->execute([
                    'role_id' => $roleId,
                    'permission_id' => (int)$pId
                ]);
            }
        }
    }
}
