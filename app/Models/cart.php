<?php

namespace models;

use database\DBConnectionManager;

require_once(dirname(__DIR__)."/core/db/dbconnectionmanager.php");

class Cart {

    private $cart_id;
    private $user_id;
    private $quantity;
    private $cartItems = [];

    private $dbConnection;

    // Constructor
    public function __construct() {
        $this->dbConnection = (new DBConnectionManager())->getConnection();
    }

    // Getters and setters
    public function getCartId() {
        return $this->cart_id;
    }

    public function setCartId($cart_id) {
        $this->cart_id = $cart_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getProductId() {
        return $this->product_id;
    }

    public function setProductId($product_id) {
        $this->product_id = $product_id;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    // CRUD operations

    public function read(){
        
    }

    public function addToCart($user_id,$product_id,$quantity) {
        $query = "INSERT INTO cart_items (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)
                  ON DUPLICATE KEY UPDATE quantity = quantity + :quantity";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        return $stmt->execute();
    }

    public function getCartItems($user_id) {
        $query = "SELECT 
            c.product_id, 
            c.quantity, 
            p.name, 
            p.price, 
            p.image_url
        FROM cart_items c
        JOIN products p ON c.product_id = p.product_id
        WHERE c.user_id = :user_id;
        ";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $cartItems = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $cartItems;
    }

    public function removeItem($user_id, $product_id) {
        $query = "DELETE FROM cart_items WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':product_id', $product_id);
        return $stmt->execute();
    }

    public function clearCart($user_id) {
        $query = "DELETE FROM cart_items WHERE user_id = :user_id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    public function updateQuantity($user_id, $product_id, $quantity) {
        $query = "UPDATE cart_items SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':product_id', $product_id);
        return $stmt->execute();
    }
}
