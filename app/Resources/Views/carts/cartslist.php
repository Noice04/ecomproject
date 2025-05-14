<?php

namespace views;

class CartList {

    public function render($cartData) {
        require("Resources\\Views\\Public\\header.php");
        
        $total = 0;
        ?>
        <!DOCTYPE html>
        <html>
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

                .remove-btn:hover {
                    background-color: darkred;
                }

                .total-row {
                    font-weight: bold;
                    background-color: #f9f9f9;
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
                                <td><?= htmlspecialchars($item['name']) ?></td>
                                <td>$<?= number_format($item['price'], 2) ?></td>
                                <td><?= (int)$item['quantity'] ?></td>
                                <td>$<?= number_format($subtotal, 2) ?></td>
                                <td>
                                    <form method="POST" action="">
                                        <input type="hidden" name="remove_item" value="<?= htmlspecialchars($item['product_id']) ?>">
                                        <button type="submit" class="remove-btn">Remove</button>
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
                <?php endif; ?>
            </div>
        </body>
        </html>
        <?php
    }
}
