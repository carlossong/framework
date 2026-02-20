<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class UserController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        // Protect all User CRUD routes
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $this->userModel = new User();
    }

    public function index()
    {
        $users = $this->userModel->all();

        $this->view('users/index', [
            'title' => 'Manage Users',
            'users' => $users
        ]);
    }

    public function create()
    {
        $this->view('users/create', [
            'title' => 'Create User'
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            // Basic validation
            if (empty($name) || empty($email) || empty($password)) {
                $this->view('users/create', [
                    'title' => 'Create User',
                    'error' => 'All fields are required.'
                ]);
                return;
            }

            if ($this->userModel->findByEmail($email)) {
                $this->view('users/create', [
                    'title' => 'Create User',
                    'error' => 'Email is already in use.'
                ]);
                return;
            }

            $this->userModel->create([
                'name' => $name,
                'email' => $email,
                'password' => $password
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

        $this->view('users/edit', [
            'title' => 'Edit User',
            'user' => $user
        ]);
    }

    public function update(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');

            if (empty($name) || empty($email)) {
                $user = $this->userModel->find($id);
                $this->view('users/edit', [
                    'title' => 'Edit User',
                    'user' => $user,
                    'error' => 'Name and Email are required.'
                ]);
                return;
            }

            // Optional password update
            if (!empty($_POST['password'])) {
                $this->userModel->update($id, [
                    'name' => $name,
                    'email' => $email,
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
                ]);
            } else {
                $this->userModel->update($id, [
                    'name' => $name,
                    'email' => $email
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
