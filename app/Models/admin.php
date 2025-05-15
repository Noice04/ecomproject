<?php

namespace models;

use database\DBConnectionManager;

require_once(dirname(__DIR__) . "/core/db/dbconnectionmanager.php");

class Admin {

    private $dbConnection;

    public function __construct() {
        $this->dbConnection = (new DBConnectionManager())->getConnection();
    }

    // Get all users for dashboard display
    public function getDashboardData() {
        $query = "SELECT user_id, username, email, is_admin FROM user";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Promote user to admin
    public function promoteUserToAdmin($user_id) {
        $query = "UPDATE user SET is_admin = 1 WHERE user_id = :user_id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    // Demote user from admin
    public function demoteUserFromAdmin($user_id) {
        $query = "UPDATE user SET is_admin = 0 WHERE user_id = :user_id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    // Delete a user by ID
    public function deleteUserById($user_id) {
        $query = "DELETE FROM user WHERE user_id = :user_id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    // Retrieve system logs
    public function getSystemLogs() {
        $query = "SELECT log_id, user_id, action, timestamp FROM logs ORDER BY timestamp DESC";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
