<?php

namespace views;

class HomePage {

    private $categories;

    public function __construct($categories) {
        $this->categories = $categories;
    }

    public function render() {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Grocery Store - Home</title>
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
                }
                .category {
                    margin-bottom: 30px;
                    background: #fff;
                    padding: 15px;
                    border-radius: 8px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                }
                .category h2 {
                    margin-top: 0;
                }
                .product {
                    display: flex;
                    justify-content: space-between;
                    padding: 8px 0;
                    border-bottom: 1px solid #ddd;
                }
                .product:last-child {
                    border-bottom: none;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Welcome to Our Grocery Store</h1>

                <?php foreach ($this->categories as $category => $products): ?>
                    <div class="category">
                        <h2><?= htmlspecialchars($category) ?></h2>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <div class="product">
                                    <span><?= htmlspecialchars($product['name']) ?></span>
                                    <span>$<?= number_format($product['price'], 2) ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No products available in this category.</p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </body>
        </html>
        <?php
    }
}
