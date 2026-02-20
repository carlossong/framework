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

        $this->view('dashboard/index', [
            'title' => 'Dashboard',
            'user_name' => $_SESSION['user_name']
        ]);
    }
}
