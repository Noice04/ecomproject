<?php

namespace views;

class OrderList {

    public function render($data) {
        require("Resources\\Views\\Public\\header.php");
        if (session_status() == PHP_SESSION_NONE) {
        session_start();
        }else if(!isset($_SESSION['user_id'])){
            header("location:logins");
        }

        require("Resources\\Views\\Public\\header.php");
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Your Orders</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background: #f8f8f8;
                }
                .container {
                    width: 90%;
                    margin: 20px auto;
                    padding-left: 250px;
                }
                .order {
                    background: #fff;
                    border-radius: 8px;
                    margin-bottom: 30px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                    padding: 20px;
                }
                .order h2 {
                    margin-top: 0;
                }
                .order-items {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 15px;
                    margin-top: 15px;
                }
                .order-item {
                    background: lightblue;
                    border-radius: 15px;
                    width: 220px;
                    height: 400px;
                    padding: 10px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: space-between;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                }
                .order-item img {
                    width: 100%;
                    height: 50%;
                    object-fit: fill;
                    border-radius: 10px;
                }
                .order-item h3, .order-item span {
                    margin: 5px 0;
                }
                .left-fixed-panel {
                    position: fixed;
                    top: 80px;
                    left: 0;
                    height: 100vh;
                    width: 200px;
                    background-color: #f4f4f4;
                    padding: 20px;
                    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
                    z-index: 1000;
                    margin-right: 5px;
                }
                .left-fixed-panel h3 {
                    font-size: 18px;
                    margin-bottom: 10px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Your Order History</h1>
                <div class="left-fixed-panel">
                    <h3>Order Panel</h3>
                    <p>Review all your previous orders here.</p>
                </div>

                <?php  if (!empty($data)): ?>
                    
                    <?php foreach ($data as $order): ?>
                        <div class="order">
                            <h2>Order #<?= htmlspecialchars($order['order_id']) ?> - <?= htmlspecialchars($order['created_at']) ?></h2>
                            <p>Total: $<?= number_format($order['total_price'], 2) ?></p>
                            <div class="order-items">
                                <?php foreach ($order['items'] as $item): ?>
                                    <div class="order-item">
                                        <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="Product Image">
                                        <h3><?= htmlspecialchars($item['name']) ?></h3>
                                        <span>Quantity: <?= $item['quantity'] ?></span>
                                        <span>Price: $<?= number_format($item['price'], 2) ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No orders have been placed yet.</p>
                <?php endif; ?>
            </div>
        </body>
         <?php require("Resources\\Views\\Public\\footer.php");?>
        </html>
        <?php
    }
}
