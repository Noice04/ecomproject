<?php

namespace models;

use database\DBConnectionManager;
use models\products;

require(dirname(__DIR__)."/models/products.php");
require_once(dirname(__DIR__)."/core/db/dbconnectionmanager.php");

class Home{

    private $dbConnection;

    // Constructor
    public function __construct() {

        $this->dbConnection = (new DBConnectionManager())->getConnection();

    }

    // Getters and setters
    public function getID() {
        return $this->id;
    }

    public function setID($id) {
        $this->id = $id;
    }  

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }  

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }  

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }    
    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }  

      

    // CRUD
    public function read() {
        $query = "SELECT * FROM products";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Product::class);
    }
    // Read single User by ID
    public function readOne() {
        $query = "SELECT * FROM user WHERE id = :userID";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':userID', $this->id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, User::class);
    }

    // Read single User by username
    public function readByUsername() {
        $query = "SELECT * FROM user WHERE username = :username";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, User::class);
    }
    //delete a single user using id
    public function deleteUser(){
        $query = "DELETE user WHERE user_id = :userID";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':userID', $this->id);
        $stmt->execute();
        return true;
    }
    //edits the user taking in any column and new value
    public function editUser($column,$newvalue){
        $query = "UPDATE user SET :column = :newvalue";
        $stmt = $this->dbConnection->prepare($query);
        //must implement a check for the values
        $stmt->bindParam(':column', $column);
        $stmt->bindParam(':newvalue', $newvalue);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, User::class);
    }

    
}
