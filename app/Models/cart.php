<?php

namespace models;

use database\DBConnectionManager;

require_once(dirname(__DIR__)."/core/db/dbconnectionmanager.php");

class Cart {

    private $cart_id;
    private $user_id;
    private $quantity;
    private $item_cart_id;
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
    
    public function addToCart($user_id,$product_id,$quantity) {
        $item_cart_id = $this->cartItemExist($user_id,$product_id);
        if ($item_cart_id!=-1){//if the item does already exist then we will add +1 to the quantity
            $this->updateQuantity($item_cart_id, 1);
        }
        else{//if the item doesnt exist in the users cart then it will be added
            $query = "INSERT INTO cart_items (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
            $stmt = $this->dbConnection->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->bindParam(':quantity', $quantity);
            return $stmt->execute();
        }
    }
    
    public function cartItemExist($user_id,$product_id){
        $query = "SELECT item_cart_id FROM cart_items WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->dbConnection->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(empty($data)){
                return -1;
            }else{
                return $data[0]['item_cart_id'];
            }
    }

    public function getCartItems($user_id) {
        $query = "SELECT 
            c.item_cart_id,
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

    public function removeItem($itemId) {
        $query = "DELETE FROM cart_items WHERE item_cart_id = :itemId";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':itemId', $itemId);
        return $stmt->execute();
    }

    public function clearCart($user_id) {
        $query = "DELETE FROM cart_items WHERE user_id = :user_id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    public function updateQuantity($item_cart_id, $quantity) {
        $query = "UPDATE cart_items SET quantity = quantity + :quantity WHERE item_cart_id = :item_cart_id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':item_cart_id', $item_cart_id);
        $stmt->bindParam(':quantity', $quantity);
        return $stmt->execute();
    }
}
