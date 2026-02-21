<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    private Role $roleModel;
    private Permission $permissionModel;

    public function __construct()
    {
        if (!isset($_SESSION['user_id']) || !is_admin()) { // Temporary auth logic until we fully switch
            $_SESSION['error_message'] = 'Access denied.';
            header('Location: /dashboard');
            exit;
        }

        $this->roleModel = new Role();
        $this->permissionModel = new Permission();
    }

    public function index()
    {
        $roles = $this->roleModel->all();
        $this->view('roles/index', [
            'title' => 'Manage Roles',
            'roles' => $roles
        ]);
    }

    public function create()
    {
        $permissions = $this->permissionModel->all();
        $this->view('roles/create', [
            'title' => 'Create Role',
            'permissions' => $permissions
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $permissionIds = $_POST['permissions'] ?? [];

            if (empty($name)) {
                $permissions = $this->permissionModel->all();
                $this->view('roles/create', ['title' => 'Create Role', 'permissions' => $permissions, 'error' => 'Name is required.']);
                return;
            }

            // Insert role and get the new ID. For simplicity, we insert then retrieve the ID since our base Model doesn't return inserted ID easily.
            $this->roleModel->insert([
                'name' => $name,
                'description' => $description
            ]);
            
            // Fetch the inserted role
            $newRole = $this->roleModel->where('name', $name);
            
            if ($newRole) {
                $this->roleModel->syncPermissions((int)$newRole['id'], $permissionIds);
            }

            $_SESSION['success_message'] = 'Role created!';
            header('Location: /roles');
            exit;
        }
    }

    public function edit(int $id)
    {
        $role = $this->roleModel->find($id);
        if (!$role) {
            header('Location: /roles');
            exit;
        }

        $permissions = $this->permissionModel->all();
        $rolePermissions = $this->roleModel->getPermissions($id);
        $rolePermissionIds = array_column($rolePermissions, 'id');

        $this->view('roles/edit', [
            'title' => 'Edit Role',
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissionIds' => $rolePermissionIds
        ]);
    }

    public function update(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $permissionIds = $_POST['permissions'] ?? [];

            if (empty($name)) {
                $role = $this->roleModel->find($id);
                $permissions = $this->permissionModel->all();
                $rolePermissions = $this->roleModel->getPermissions($id);
                $rolePermissionIds = array_column($rolePermissions, 'id');
                
                $this->view('roles/edit', [
                    'title' => 'Edit Role',
                    'role' => $role,
                    'permissions' => $permissions,
                    'rolePermissionIds' => $rolePermissionIds,
                    'error' => 'Name is required.'
                ]);
                return;
            }

            $this->roleModel->update($id, [
                'name' => $name,
                'description' => $description
            ]);

            $this->roleModel->syncPermissions($id, $permissionIds);

            $_SESSION['success_message'] = 'Role updated!';
            header('Location: /roles');
            exit;
        }
    }

    public function destroy(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Prevent deleting the Admin role (ID 1)
            if ($id === 1) {
                 $_SESSION['error_message'] = 'Cannot delete root Admin role.';
                 header('Location: /roles');
                 exit;
            }

            $this->roleModel->delete($id);
            $_SESSION['success_message'] = 'Role deleted!';
            header('Location: /roles');
            exit;
        }
    }
}
