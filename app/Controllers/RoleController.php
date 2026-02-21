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
        if (!isset($_SESSION['user_id']) || !is_admin()) { // Lógica de autenticação temporária até mudarmos completamente
            $_SESSION['error_message'] = 'Acesso negado.';
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
            'title' => 'Gerenciar Funções',
            'roles' => $roles
        ]);
    }

    public function create()
    {
        $permissions = $this->permissionModel->all();
        $this->view('roles/create', [
            'title' => 'Criar Função',
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
                $this->view('roles/create', ['title' => 'Criar Função', 'permissions' => $permissions, 'error' => 'O nome é obrigatório.']);
                return;
            }

            // Insere a função e obtém o novo ID. Por simplicidade, inserimos e depois recuperamos o ID, já que nosso Model base não retorna o ID inserido facilmente.
            $this->roleModel->insert([
                'name' => $name,
                'description' => $description
            ]);
            
            // Busca a função inserida
            $newRole = $this->roleModel->where('name', $name);
            
            if ($newRole) {
                $this->roleModel->syncPermissions((int)$newRole['id'], $permissionIds);
            }

            $_SESSION['success_message'] = 'Função criada!';
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
            'title' => 'Editar Função',
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
                    'title' => 'Editar Função',
                    'role' => $role,
                    'permissions' => $permissions,
                    'rolePermissionIds' => $rolePermissionIds,
                    'error' => 'O nome é obrigatório.'
                ]);
                return;
            }

            $this->roleModel->update($id, [
                'name' => $name,
                'description' => $description
            ]);

            $this->roleModel->syncPermissions($id, $permissionIds);

            $_SESSION['success_message'] = 'Função atualizada!';
            header('Location: /roles');
            exit;
        }
    }

    public function destroy(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Evita a exclusão da função Admin (ID 1)
            if ($id === 1) {
                 $_SESSION['error_message'] = 'Não é possível excluir a função Admin raiz.';
                 header('Location: /roles');
                 exit;
            }

            $this->roleModel->delete($id);
            $_SESSION['success_message'] = 'Função excluída!';
            header('Location: /roles');
            exit;
        }
    }
}
