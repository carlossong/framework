<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class UserController extends Controller
{
    private User $userModel;
    private \App\Models\Role $roleModel;

    public function __construct()
    {
        // Protect all User CRUD routes - Must be logged in and be an admin
        if (!isset($_SESSION['user_id']) || !is_admin()) {
            $_SESSION['error_message'] = 'You do not have permission to access this area.';
            header('Location: /dashboard');
            exit;
        }

        $this->userModel = new User();
        $this->roleModel = new \App\Models\Role();
    }

    public function index()
    {
        $db = \App\Core\Database::connect();
        $stmt = $db->query("SELECT users.*, roles.name as role_name FROM users LEFT JOIN roles ON users.role_id = roles.id ORDER BY users.id DESC");
        $users = $stmt->fetchAll();

        $this->view('users/index', [
            'title' => 'Manage Users',
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = $this->roleModel->all();
        $this->view('users/create', [
            'title' => 'Create User',
            'roles' => $roles
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $role_id = $_POST['role_id'] ?? null;

            // Basic validation
            if (empty($name) || empty($email) || empty($password) || empty($role_id)) {
                $roles = $this->roleModel->all();
                $this->view('users/create', [
                    'title' => 'Create User',
                    'roles' => $roles,
                    'error' => 'All fields are required.'
                ]);
                return;
            }

            if ($this->userModel->findByEmail($email)) {
                $roles = $this->roleModel->all();
                $this->view('users/create', [
                    'title' => 'Create User',
                    'roles' => $roles,
                    'error' => 'Email is already in use.'
                ]);
                return;
            }

            $this->userModel->insert([
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role_id' => (int)$role_id
            ]);

            $_SESSION['success_message'] = 'User successfully created!';
            header('Location: /users');
            exit;
        }
    }

    public function edit(int $id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            header('Location: /users');
            exit;
        }

        $roles = $this->roleModel->all();

        $this->view('users/edit', [
            'title' => 'Edit User',
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');

            $role_id = $_POST['role_id'] ?? null;

            if (empty($name) || empty($email) || empty($role_id)) {
                $user = $this->userModel->find($id);
                $roles = $this->roleModel->all();
                $this->view('users/edit', [
                    'title' => 'Edit User',
                    'user' => $user,
                    'roles' => $roles,
                    'error' => 'Name, Email and Role are required.'
                ]);
                return;
            }

            // Optional password update
            if (!empty($_POST['password'])) {
                $this->userModel->update($id, [
                    'name' => $name,
                    'email' => $email,
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'role_id' => (int)$role_id
                ]);
            } else {
                $this->userModel->update($id, [
                    'name' => $name,
                    'email' => $email,
                    'role_id' => (int)$role_id
                ]);
            }

            $_SESSION['success_message'] = 'User successfully updated!';
            header('Location: /users');
            exit;
        }
    }

    public function destroy(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Prevent users from deleting themselves
            if ($id === $_SESSION['user_id']) {
                header('Location: /users');
                exit;
            }

            $this->userModel->delete($id);
            $_SESSION['success_message'] = 'User successfully deleted!';
            header('Location: /users');
            exit;
        }
    }
}
