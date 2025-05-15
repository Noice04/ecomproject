<?php

namespace models;

use database\DBConnectionManager;

require_once(dirname(__DIR__)."/core/db/dbconnectionmanager.php");

class Order {

    private $order_id;
    private $user_id;
    private $total_price;
    private $created_at;
    private $status;
    private $items = [];

    private $dbConnection;

    // Constructor
    public function __construct() {
        $this->dbConnection = (new DBConnectionManager())->getConnection();
    }

    // Getters and setters
    public function getOrderId() {
        return $this->order_id;
    }

    public function setOrderId($order_id) {
        $this->order_id = $order_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function getTotalPrice() {
        return $this->total_price;
    }

    public function setTotalPrice($total_price) {
        $this->total_price = $total_price;
    }

    public function getOrderDate() {
        return $this->order_date;
    }

    public function setOrderDate($order_date) {
        $this->order_date = $order_date;
    }

    // CRUD Operations

    public function createOrder($user_id, $total_price) {
        $query = "INSERT INTO `order` (user_id, total_price, created_at) VALUES (:user_id, :total_price, NOW())";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':total_price', $total_price);
        if ($stmt->execute()) {
            return $this->dbConnection->lastInsertId();
            
        }
        return false;
    }

    public function addOrderItem($order_id, $product_id, $quantity, $price) {
        $query = "INSERT INTO order_item (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }

    public function getOrderItems($order_id) {
        $query = "SELECT 
            oi.order_item_id,
            oi.product_id,
            oi.quantity,
            oi.price,
            p.name,
            p.image_url
        FROM order_item oi
        JOIN products p ON oi.product_id = p.product_id
        WHERE oi.order_id = :order_id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getOrdersByUser($user_id) {
        $query = "SELECT * FROM `order` WHERE user_id = :user_id ORDER BY order_id DESC";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $orders = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($orders as &$order) {
            $order['items'] = $this->getOrderItems($order['order_id']);
        }
        return $orders;
    }

    public function deleteOrder($order_id) {
        $query = "DELETE FROM `order` WHERE order_id = :order_id";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        return $stmt->execute();
    }
}
