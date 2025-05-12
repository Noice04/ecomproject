<?php 

namespace models;

use database\DBConnectionManager;
use models\User;

require(dirname(__DIR__)."/models/user.php");
require_once(dirname(__DIR__)."/core/db/dbconnectionmanager.php");

class Register {

    private $username;
    private $email;
    private $password;
    private $dbConnection;

    // Constructor
    public function __construct() {
        $this->dbConnection = (new DBConnectionManager())->getConnection();
    }

    public function register($data) {

        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        
        // Check if user already exists
        $query = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $existingUser = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (!empty($existingUser)) {
            // User already exists
            return false;
        }

        // Insert new user
        $query = "INSERT INTO user (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->dbConnection->prepare($query);
        
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $hashedPassword);

        $success = $stmt->execute();

        if ($success) {
            session_start();
            $_SESSION['user_id']= $this->dbConnection->lastInsertId();
            $_SESSION['username']= $this->username;

            return [
                'user_id' => $this->dbConnection->lastInsertId(),
                'username' => $this->username
            ];
        }

        return false;
    }
}
