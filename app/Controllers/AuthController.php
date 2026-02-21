<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        $this->view('auth/login', ['title' => 'Login']);
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            
            // Armazenamento de Sessão RBAC
            $roleId = $user['role_id'] ? (int)$user['role_id'] : null;
            if ($roleId) {
                $role = $userModel->getRole($roleId);
                $_SESSION['role_name'] = $role ? $role['name'] : 'Usuário';
                
                // Obter nomes das permissões
                $permissions = $userModel->getPermissions($roleId);
                $_SESSION['permissions'] = array_column($permissions, 'name');
            } else {
                $_SESSION['role_name'] = 'Usuário';
                $_SESSION['permissions'] = [];
            }

            header('Location: /dashboard');
            exit;
        }

        $this->view('auth/login', [
            'title' => 'Login',
            'error' => 'E-mail ou senha inválidos'
        ]);
    }

    public function showRegister()
    {
        $this->view('auth/register', ['title' => 'Register']);
    }

    public function register()
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($name) || empty($email) || empty($password)) {
            $this->view('auth/register', [
                'title' => 'Registrar',
                'error' => 'Todos os campos são obrigatórios'
            ]);
            return;
        }

        $userModel = new User();
        
        if ($userModel->findByEmail($email)) {
             $this->view('auth/register', [
                'title' => 'Registrar',
                'error' => 'E-mail já cadastrado'
            ]);
            return;
        }

        $userModel->insert([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role_id' => 2 // Função de Usuário padrão
        ]);

        header('Location: /login');
        exit;
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /');
        exit;
    }
}
