<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Simple auth check
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $userModel = new \App\Models\User();
        $totalUsers = count($userModel->all());

        // Basic active sessions estimation based on session files (very simple approach)
        $sessionPath = session_save_path() ?: sys_get_temp_dir();
        $activeSessions = count(glob($sessionPath . '/sess_*'));

        $this->view('dashboard/index', [
            'title' => 'Dashboard',
            'user_name' => $_SESSION['user_name'],
            'total_users' => $totalUsers,
            'active_sessions' => $activeSessions > 0 ? $activeSessions : 1
        ]);
    }
}
