<?php

namespace views;

class Homepage {

    
    
    public function render($data,$categories) {
        
        ?>

        <?php require("Resources\\Views\\Public\\header.php");?>

        <!DOCTYPE html>
        <html>
        <head>
            <?php //non necessary currently?>
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            <script>
                const isLoggedIn = <?= !isset($_SESSION['user_id']) ? 'true' : 'false' ?>;
                function addToCart(productId){
                    if (isLoggedIn) {
                        window.location.href = "logins";
                        return;
                    }
                    console.log("noice");
                }

            </script>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background: white;
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
                    margin: auto;
                    flex-shrink:1;
                    background: #fff;
                    border-radius: 15px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                    width: 240px;
                    height:500px;
                    display: flex; 
                    gap: 10px;
                    flex-wrap: wrap;
                    overflow: hidden;
                    
                }
                .product:hover{
                    border-color: #3399ff;
                    box-shadow: 0 0 10px rgba(51, 153, 255, 0.5);
                }
                .product h2 {
                    margin-top: 0;
                    margin:20;
                    padding-left:10
                }
                .product_details {/* gotta tweak */
                    
                    
                    
                }
                .product_details:last-child {
                    border-bottom: none;
                }
                .products-row{
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
                }
                .promo{
                    display: flex;
                    text-align:center;
                    margin: auto;
                    background-color: #90EE90;
                    border-radius: 15px;
                    padding: 30px;
                    align-items: center;
                    justify-content: space-between;
                    max-width: 900px;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
                    display: flex;
                    
                }
                .allbutheaderandfooter{
                    font-family: Arial, sans-serif;
                    margin-top: 25px;
                    padding: 40px;
                    justify-content: center;
                    align-items: center;
                    display: flex;
                }
                .promo-text {
                    max-width: 60%;
                }

                .promo-text h1 {
                    color: #146c2b;
                    font-size: 2rem;
                    margin: 0 0 15px 0;
                }

                .promo-text p {
                    color: #333;
                    font-size: 1rem;
                    margin-bottom: 20px;
                }

                .promo-text button {
                    background-color: #157347;
                    color: white;
                    border: none;
                    padding: 12px 24px;
                    border-radius: 8px;
                    font-weight: bold;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                }
                .category-container{
                    min-width: 100px;
                    min-height:40px;
                    
                    margin-bottom:20px;
                    background-color: white;
                    border-radius: 15px;
                    padding: 20px;
                    justify-content: center;
                    margin: auto;
                    flex-grow:1;
                    flex-shrink:1;
                    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.25);
                    display: flex;
                    text-align:center;
                }
                

                .product-description{
                    margin:20px;
                }
                .add-to-cart{
                    background-color: #157347;
                    color: white;
                    border: none;
                    padding: 12px 24px;
                    border-radius: 8px;
                    font-weight: bold;
                    cursor: pointer;
                    transition: background-color 0.3s ease;

                }
                .category-button {
                    flex: 1 1 calc(25% - 10px); /* 4 items per row with spacing */
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    gap: 5px;
                    padding: 15px;
                    border: none;
                    background-color: #f0f0f0;
                    border-radius: 10px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                    font-size: 16px;
                    min-width: 100px;
                }
                .category-button:hover {
                    background-color: #e0e0e0;
                }
                .category-button i {
                    font-size: 24px;
                }
                .category-form {
                    display: flex;
                    justify-content: space-between; 
                    flex-wrap: wrap;
                    gap: 10px;
                    width: 100%;
                }

            </style>
        </head>
        <body>
                 
            <div class="allbutheaderandfooter">
                <div class="container">


                    <div class="promo">
                        <div class="promo-text">
                        <h1>Fresh Groceries Delivered to Your Door</h1>
                        <p>Shop the freshest produce, dairy, and pantry <br>staples from the comfort of your home.</p>
                        <button onClick="window.location.href='products'">Shop Now</button>
                        </div>
                        <div class="promo-image">
                            <?php //using pixabay for their free pictures?>
                        <img src="https://media.istockphoto.com/id/1542614865/photo/man-shopping-vegetables-in-groceries-store.jpg?s=1024x1024&w=is&k=20&c=GrlyoGq9JtmJvq6ESmbzvYssDmlj6TGtgbENuTE2PnM=" width="400px" alt="Fresh Groceries" />
                        </div>
                    </div>

                    <h2>Shop by Category</h2>

                    <form action="products" method="POST" class="category-form">
                        <button type="submit" name="selectedcategory" value="3" class="category-button">
                            <i class="fa-solid fa-apple-whole"></i>
                            <p>Fruits</p>
                        </button>

                        <button type="submit" name="selectedcategory" value="2" class="category-button">
                            <i class="fas fa-bread-slice"></i>
                            <p>Bakery</p>
                        </button>

                        <button type="submit" name="selectedcategory" value="1" class="category-button">
                            <i class="fa-solid fa-cheese"></i>
                            <p>Dairy</p>
                        </button>

                        <button type="submit" name="selectedcategory" value="4" class="category-button">
                            <i class="fa-solid fa-bacon"></i>
                            <p>Meat</p>
                        </button>
                    </form>
                    
                    <div class="weeklydeals">
                        <div style="display:flex;justify-content: space-between;align-items: center;">
                            <h2>Weekly Deals</h2>
                            <a href="deals">View All</a>
                        </div>
                        

                    

                        <?php
                            if (!empty($data)): ?>
                            <div class="products-row">
                                <?php foreach ($data as $product): ?>

                                
                                    <div class="product">
                                        <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="Image" style="height:60%; width:100%;object-fit: fill;" />
                                        <div class="product-description">
                                            <h2><?= htmlspecialchars($product['name']) ?></h2>
                                                 
                                            <div class="product_details">
                                                <span><?= htmlspecialchars($product['description']) ?></span>
                                                <br>
                                                <span>$<?= number_format($product['price'], 2) ?></span>
                                                <br>
                                                <button class="add-to-cart" onclick="addToCart('${product.product_id}')">Add To Cart</button>
                                            </div>
                                        
                                        </div>
                                        
                            
                                    </div>
                                
                                <?php endforeach; ?>
                            </div>
                            <?php else: ?>
                                <p>No products available in the store.<br>Our sincerest apologies</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

        </body>
        <?php require("Resources\\Views\\Public\\footer.php");?>
        </html>
        <?php
    }
}
