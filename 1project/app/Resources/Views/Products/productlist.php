<?php

namespace views;

class ProductList {

    
    public function render($data) {
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
                .top-right-buttons{
                    position:absolute;
                    top:20px;
                    right:20px;
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
                <?php if (!empty($data)): ?>
    <?php 
    $groupedProducts = [];
    foreach ($data as $product) {
        $groupedProducts[$product['category']][] = $product;
    }
    ?>

    <?php foreach ($groupedProducts as $category => $products): ?>
        <div class="category-section">
            <h2><?= htmlspecialchars($category) ?></h2>
            <div class="products-row">
                <?php foreach ($products as $product): ?>
                    <div class="product">
                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                        <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="Image" style="width:200px; height:150px;" />
                        <div class="product_details">
                            <span><?= htmlspecialchars($product['description']) ?></span>
                            <span>$<?= number_format($product['price'], 2) ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No products available in the store.<br>Our sincerest apologies</p>
<?php endif; ?>

            </div>
        </body>
        </html>
        <?php
    }
}
