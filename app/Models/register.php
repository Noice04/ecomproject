<?php 

namespace models;

use database\DBConnectionManager;
use models\User;
use OTPHP\TOTP;

require 'vendor/autoload.php';
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
        $query = "SELECT * FROM user WHERE username = :username";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();
        $existingUser = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (!empty($existingUser)) {
            // User already exists
            return false;
        }

        // Insert new user
        $query = "INSERT INTO user (username, email, password,twofa_secret) VALUES (:username, :email, :password,:secret)";
        $stmt = $this->dbConnection->prepare($query);
        
        $totp = TOTP::create();
        $totp->setLabel($this->username); // or username
        $totp->setIssuer('MyApp'); // your app name
        $twofaSecret = $totp->getSecret();

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':secret', $twofaSecret);
        $success = $stmt->execute();

        if ($success) {
            session_start();
            $_SESSION['temp_user_id']= $this->dbConnection->lastInsertId();
            $_SESSION['temp_username']= $this->username;
            $_SESSION['new_2fa_secret'] = $twofaSecret;
            return [
                'temp_user_id' => $this->dbConnection->lastInsertId(),
                'temp_username' => $this->username
                
            ];
        }

        return false;
    }
}
