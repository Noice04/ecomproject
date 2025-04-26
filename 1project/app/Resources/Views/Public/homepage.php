<?php

namespace views;

class Homepage {

    
    public function render($data,$categories) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
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
                .top-right-buttons{
                    width: 100px;
                    height: 50px;
                    
                }
                
                .product {
                    width: 200px;
                    margin-bottom: 30px;
                    background: #fff;
                    padding: 15px;
                    border-radius: 8px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                }
                .product h2 {
                    margin-top: 0;
                }
                .product_details {
                    display: flex;
                    justify-content: space-between;
                    padding: 8px 0;
                    border-bottom: 1px solid #ddd;
                }
                .product_details:last-child {
                    border-bottom: none;
                }
            </style>
        </head>
        <body>
            <div class="container">

                <h1>Welcome to Our Grocery Store</h1>
                <button type="button" class="top-right-buttons" style="position:absolute;top: 20px; right: 140px;">Log in</button>
                    <button type="button" class="top-right-buttons" style="position:absolute;top: 20px; right: 20px;">Sign up</button>

                
                <?php if (!empty($data)): ?>
                    <?php foreach ($data as $product): ?>
                        <div class="product">
                            <h2><?= htmlspecialchars($product['name']) ?></h2>
                            <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="Image" style="width:200px; height:150px;" />                   
                        
                                
                                    <div class="product_details">
                                        <span><?= htmlspecialchars($product['description']) ?></span>
                                        <span>$<?= number_format($product['price'], 2) ?></span>
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
