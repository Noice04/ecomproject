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
                .products-row{
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                }

            </style>
        </head>
        <body>
            <div class="container">

                <h1>Welcome to Our Grocery Store</h1>

                <?php 
                session_start();
                if (!isset($_SESSION['user_id'])): 
                ?>
                <form action="logins" method="GET">
                    <?php  //changed the name to page so that within the index i may use this to find which page i should load next?>
                <button type="submit" name="page" value="login" class="top-right-buttons" style="position:absolute;top: 20px; right: 140px;">Log in</button>
                </form>

                <form action="registers" method="GET">
                <button type="submit" class="top-right-buttons" style="position:absolute;top: 20px; right: 20px;">Sign up</button>
                </form>

                <?php else: ?>
                    
                    <form action="/app/registers.php" method="POST">
                <p style="position:absolute;top: 20px; right: 140px;"> Hello <?php echo $_SESSION['username'] ?> </p>
                <button type="submit" name="page" value="Log out"class="top-right-buttons" style="position:absolute;top: 20px; right: 20px;">Log out</button>
                </form>
                
                <?php endif ?>

                    

                
                <?php if (!empty($data)): ?>
                <div class="products-row">
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
                </div>
                <?php else: ?>
                    <p>No products available in the store.<br>Our sincerest apologies</p>
                <?php endif; ?>
            </div>
        </body>
        </html>
        <?php
    }
}
