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
        return $this->image_url;
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
    public function getCategories() {
        $query = "SELECT * FROM category";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function get6products() {
        $query = "SELECT * FROM products LIMIT 6";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function readByCategory($category){
        $query = "SELECT * FROM products WHERE category_id = :categoryID";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':categoryID',$category);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getCategoryName($category_id){
        $query = "SELECT name FROM category WHERE category_id = :categoryID";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':categoryID',$category_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function search($term) {
        $query = "SELECT * FROM products WHERE name LIKE :term OR description LIKE :term";
        $stmt = $this->dbConnection->prepare($query);
        $searchTerm = '%' . $term . '%';
        $stmt->bindParam(':term', $searchTerm);
        $stmt->execute();
        return $stmt->fetchAll();
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
    

    
}


