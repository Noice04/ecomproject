<?php

namespace views;

class CartList {

    public function render($cartData) {
        require("Resources\\Views\\Public\\header.php");
        if (session_status() == PHP_SESSION_NONE) {
        session_start();
        }else if(!isset($_SESSION['user_id'])){
            header("location:logins");
        }
        

        $total = 0;
        ?>
        <!DOCTYPE html>
        <html>
            <script>
                
            </script>
        <head>
            

            <title>Your Cart</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background: #f8f8f8;
                    margin:0px;
                    margin-top: 100px;
                    padding: 0;
                }

                .container {
                    margin-top:200px;
                    width: 80%;
                    margin: 50px auto;
                    background: white;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                }

                h1 {
                    text-align: center;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }

                th, td {
                    border: 1px solid #ccc;
                    padding: 10px;
                    text-align: center;
                }

                th {
                    background-color: #f4f4f4;
                }

                .remove-btn {
                    background-color: red;
                    color: white;
                    border: none;
                    padding: 5px 10px;
                    border-radius: 5px;
                    cursor: pointer;
                }
                .plus-and-minusbtn {
                    background-color: green;
                    color: white;
                    border: none;
                    padding: 5px 10px;
                    border-radius: 5px;
                    cursor: pointer;
                }

                .remove-btn:hover {
                    background-color: darkred;
                }

                .total-row {
                    font-weight: bold;
                    background-color: #f9f9f9;
                }
                .confirm-btn {
                    background-color: #4CAF50;
                    color: white;
                    padding: 16px 40px; 
                    font-size: 18px;     
                    border: none;
                    border-radius: 10px;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                }

                .confirm-btn:hover {
                    background-color: #45a049;
                }

            </style>
        </head>
        <body>
            <div class="container">
                <h1>Your Shopping Cart</h1>

                <?php if (empty($cartData)): ?>
                    <p>Your cart is empty.</p>
                <?php else: ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cartData as $item): 
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                            ?>
                            <tr>
                                <td style="display: flex; align-items: center; gap: 10px;">
                                    <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                                    <span><?= htmlspecialchars($item['name']) ?></span>
                                </td>
                                <td>$<?= number_format($item['price'], 2) ?></td>
                                <td>
                                    <table>
                                        <tr>
                                            <form  action="carts" method="POST">
                                                <input type="hidden" name="item_cart_id" value=<?php echo $item['item_cart_id'] ?> >
                                                <button <?php if($item['quantity']==1){echo 'disabled';} ?> type="submit" class="plus-and-minusbtn" name="action" value="reduceOne">-</button>
                                            </form>

                                            <?= (int)$item['quantity'] ?>

                                            <form action="carts" method="POST">
                                                <input type="hidden" name="item_cart_id" value=<?php echo $item['item_cart_id'] ?> >
                                                <button type="submit" class="plus-and-minusbtn" name="action" value="increaseOne">+</button>
                                            </form>
                                        </tr>
                                    </table>
                                    
                                </td>
                                <td>$<?= number_format($subtotal, 2) ?></td>
                                <td>
                                    <form method="POST" action="carts">
                                        <input type="hidden" name="item_cart_id" value=<?php echo $item['item_cart_id'] ?> >
                                        <button type="submit" class="remove-btn" name="action" value="removeItem">Remove</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr class="total-row">
                                <td colspan="3">Total</td>
                                <td colspan="2">$<?= number_format($total, 2) ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="text-align:center;margin-top:20px;">
                        <form action="carts" method="POST">
                            <button type="submit" name="action" value="confirmOrder" class="confirm-btn">Confirm Order</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </body>
        </html>
        <?php
    }
}
