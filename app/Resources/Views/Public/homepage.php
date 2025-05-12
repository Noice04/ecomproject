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
                    margin: 0;
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
                

            </style>
        </head>
        <body>
                 
            <div class="allbutheaderandfooter">
                <div class="container">


                    <div class="promo">
                        <div class="promo-text">
                        <h1>Fresh Groceries Delivered to Your Door</h1>
                        <p>Shop the freshest produce, dairy, and pantry staples from the comfort of your home.</p>
                        <button>Shop Now</button>
                        </div>
                        <div class="promo-image">
                            <?php //using pixabay for their free pictures?>
                        <img src="https://media.istockphoto.com/id/1542614865/photo/man-shopping-vegetables-in-groceries-store.jpg?s=1024x1024&w=is&k=20&c=GrlyoGq9JtmJvq6ESmbzvYssDmlj6TGtgbENuTE2PnM=" width="400px" alt="Fresh Groceries" />
                        </div>
                    </div>

                    <h2>Shop by Category</h2>

                    <div style="display: flex; gap: 10px;flex-wrap: wrap;" >
                        
                       
                            <div  class="category-container"  onclick="window.location='fruits';">
                                <i class="fa-solid fa-apple-whole"></i>
                                <p>Fruits</p>
                            </div>
                       
                        
                        
                            <div class="category-container"onclick="window.location='vegetables';">
                            <i class="fa-solid fa-carrot"style="height:4px;"></i>
                            <br>
                            <p>Vegetables</p>
                            </div>
                        
                        
                            <div class="category-container"onclick="window.location='dairy';">
                            <i class="fa-solid fa-cheese"></i>
                            <p>Dairy</p>
                            </div>
                        
                       
                            <div class="category-container"onclick="window.location='meat';">
                            <i class="fa-solid fa-bacon"style="height:4px;"></i>
                            <p>Meat</p>
                            </div>
                        
                    </div>
                    
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
                                                <button class="add-to-cart">Add To Cart</button>
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
