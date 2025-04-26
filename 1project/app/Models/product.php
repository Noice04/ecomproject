<?php

namespace models;

use database\DBConnectionManager;

require_once(dirname(__DIR__)."/core/db/dbconnectionmanager.php");

class Product{

    private $id;
    private $name;
    private $description;
    private $price;
    private $stock;
    private $category_id;
    private $image_url;

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
    public function getImageUrl() {
        return $this->$image_url;
    }

    public function setImageUrl($image_url) {
        $this->image_url = $image_url;
    }  

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }  

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }  

    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }    
    public function getCategory_id() {
        return $this->category_id;
    }

    public function setCategory_id($category_id) {
        $this->category_id = $category_id;
    }  

      

    // CRUD

    public function read() {
        $query = "SELECT * FROM products";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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

    //create user

    public function createUser($username,$email,$password,$address,$role){
        $passwordhashed = password_hash($password);
        $query = "INSERT INTO user VALUES(:username, :email , :passwordhashed, :address, :role)";
        $stmt = $this->dbConnection->prepare($query);
        //must implement a check for the values
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':passwordhashed', $passwordhashed);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, User::class);
    } 

    
}


