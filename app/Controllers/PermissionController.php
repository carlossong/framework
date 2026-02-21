<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Permission;

class PermissionController extends Controller
{
    private Permission $permissionModel;

    public function __construct()
    {
        if (!isset($_SESSION['user_id']) || !is_admin()) { // Temporary auth logic until we fully switch
            $_SESSION['error_message'] = 'Access denied.';
            header('Location: /dashboard');
            exit;
        }

        $this->permissionModel = new Permission();
    }

    public function index()
    {
        $permissions = $this->permissionModel->all();
        $this->view('permissions/index', [
            'title' => 'Manage Permissions',
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        $this->view('permissions/create', ['title' => 'Create Permission']);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if (empty($name)) {
                $this->view('permissions/create', ['title' => 'Create Permission', 'error' => 'Name is required.']);
                return;
            }

            $this->permissionModel->insert([
                'name' => $name,
                'description' => $description
            ]);

            $_SESSION['success_message'] = 'Permission created!';
            header('Location: /permissions');
            exit;
        }
    }

    public function edit(int $id)
    {
        $permission = $this->permissionModel->find($id);
        if (!$permission) {
            header('Location: /permissions');
            exit;
        }

        $this->view('permissions/edit', [
            'title' => 'Edit Permission',
            'permission' => $permission
        ]);
    }

    public function update(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if (empty($name)) {
                $permission = $this->permissionModel->find($id);
                $this->view('permissions/edit', ['title' => 'Edit Permission', 'permission' => $permission, 'error' => 'Name is required.']);
                return;
            }

            $this->permissionModel->update($id, [
                'name' => $name,
                'description' => $description
            ]);

            $_SESSION['success_message'] = 'Permission updated!';
            header('Location: /permissions');
            exit;
        }
    }

    public function destroy(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->permissionModel->delete($id);
            $_SESSION['success_message'] = 'Permission deleted!';
            header('Location: /permissions');
            exit;
        }
    }
}
