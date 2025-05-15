<?php

namespace controllers;

use models\Admin;
use views\AdminDashboard;

require(dirname(__DIR__) . "/models/admin.php");
require(dirname(__DIR__) . "/resources/views/admin/admindashboard.php");

class AdminController {

    private Admin $admin;

    public function __construct() {
        $this->admin = new Admin();
    }

    public function read() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
            header('location:homes'); // Show login if not admin
            return;
        }

        $dashboardData = $this->admin->getDashboardData(); // hypothetical method
        (new AdminDashboard())->render($dashboardData);
    }

    public function create($data) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
           header('location:homes');
            return;
        }

        switch ($data['action']) {
            case "deleteUser":
                $this->admin->deleteUserById($data['user_id']);
                break;
            case "promote":
                $this->admin->promoteUserToAdmin($data['user_id']);
                
                break;
            case "demote":
                $this->admin->demoteUserFromAdmin($data['user_id']);
                
                break;
            case "viewLogs":
                $logs = $this->admin->getSystemLogs();
                (new AdminDashboard())->render($logs);
                return;
            default:
                // Optional: redirect or render an error view
        }

        $this->read(); // Refresh admin dashboard after action
    }
}

?>
