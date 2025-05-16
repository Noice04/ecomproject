<?php

namespace views;

class ProductList {

    
    public function render($data,$categories) {
       
        require("Resources\\Views\\Public\\header.php")
        
        ?>
        <!DOCTYPE html>
        <html>
            <script>
                function scrollRowRight(amount,row) {
                    document.getElementById(row).scrollBy({ left: amount, behavior: 'smooth' });
                }

                function scrollRowLeft(amount,row) {
                    document.getElementById(row).scrollBy({ left: -amount, behavior: 'smooth' });
                }

                const isLoggedIn = <?= !isset($_SESSION['user_id']) ? 'true' : 'false' ?>;
                

                function addToCart(productId,quantity){
                    if (isLoggedIn) {
                        window.location.href = "logins";//this makes sure my user is loged in before proceding
                        return;
                    }
                    const formData = new FormData();
                    formData.append('product_id',productId);
                    formData.append('quantity',1);
                    formData.append('action',"addToCart");

                    //gotta add to cart without moving the user from the page so ajax for behind the scenes is perfect
                    fetch('carts', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert('Product added to cart!');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }

            </script>
        <head>
            <title>Products</title>
            <style>
                html, body {
                    height: 100%;
                    margin: 0;
                    padding: 0;
                }
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
                    height:90%;
                    margin: 20px auto;
                    padding-left:250px;
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
                .scroll-container{
                    position: relative;
                    width: 100%;
                    overflow: hidden;
                }
                .scroll-row {
                    display: flex;
                    overflow-x: auto;
                    scroll-behavior: smooth;
                    gap: 15px;
                    padding: 15px;
                    width: 100%;
                    padding-right:25px;
                }
                .scroll-item {
                    min-width: 150px;
                    height: 402px;
                    background: lightblue;
                    flex-shrink: 0;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 15px;
                }
                .arrow {
                    position: absolute;
                    top: 50%;
                    transform: translateY(-50%);
                    background: white;
                    border: 1px solid #ccc;
                    cursor: pointer;
                    padding: 0.5rem;
                    border-radius: 50%;
                    font-size: 1.2rem;
                    z-index: 10;
                    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
                }

                .left-arrow {
                    left: 10px;
                }

                .right-arrow {
                    right: 10px;
                }
                .product-description{
                    margin-left:15px;
                }
                .product_details:last-child {
                    border-bottom: none;
                }
                .product {
                    margin: auto;
                    flex-shrink:1;
                    background: #fff;
                    border-radius: 15px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                    width: 220px;
                    height:400px;
                    display: flex; 
                    gap: 10px;
                    flex-wrap: wrap;
                    overflow: hidden;
                    
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
                .row-title-and-viewall{
                    display: flex;

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
                    margin-right:5px;   
                }
                .left-fixed-panel button {
                    display: block;
                    width: 100%;
                    padding: 12px;
                    margin-bottom: 12px;
                    font-size: 16px;
                    font-weight: bold;
                    color: #333;
                    background-color: #e7e7e7;
                    border: 1px solid #ccc;
                    border-radius: 8px;
                    cursor: pointer;
                    transition: all 0.2s ease;
                }

                .left-fixed-panel button:hover {
                    background-color: #157347;
                    color: white;
                    border-color: #145c37;
                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                }
                .allbutheaderandfooter{
                    font-family: Arial, sans-serif;
                    margin: auto;
                    min-height: 60vh;
                    padding: 40px;
                    justify-content: center;
                    align-items: center;
                    display: flex;
                    flex-direction: column;
                }



            </style>
        </head>
        <body>
            <div class="allbutheaderandfooter" > 
                <div class="container">
                    <h1>Here are our products</h1>

                    <form method="GET" action="" style="margin-bottom: 20px;">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Search for a product..." 
                            value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" 
                            style="width: 300px; padding: 10px; font-size: 16px; border-radius: 5px; border: 1px solid #ccc;"
                        />
                        <button 
                            type="submit" 
                            style="padding: 10px 20px; font-size: 16px; background-color: #157347; color: white; border: none; border-radius: 5px; cursor: pointer;"
                        >
                            Search
                        </button>
                    </form>

                    

                    <div class="left-fixed-panel">
                        <form action="" method="POST">
                            <?php if (!empty($data)): ?>
                                <?php foreach($categories as $category):?>
                                    <button type="submit"name="selectedcategory"  value=<?php echo $category['category_id']; ?>><?php echo $category['name']; ?></button>
                                    <br>
                                <?php endforeach ?>
                            <?php endif ?>
                        </form>
                        
                    </div>

                    <?php if (!empty($data)): ?>
                        <?php foreach($categories as $category):?>
                            <?php
                                
                                $categoryProducts = array_filter($data, function($product) use ($category) {
                                    return $product['category_id'] == $category['category_id'];
                                });

                                if (empty($categoryProducts)) {
                                    continue;
                                }
                            ?>
                            
                            
                            <div style="display:flex;justify-content: space-between;align-items: center;">
                                <h2><?php echo $category['name']?> products</h2>
                            </div>
                            <div class="scroll-container">
                                <div class="scroll-row" id=<?php echo $category['name']."row"?>>
                                <button class="arrow left-arrow" onclick="scrollRowLeft(500,'<?php echo $category['name'].'row' ?>')">←</button>    
                                    <?php
                                        foreach($categoryProducts  as $product){
                                            if($product['category_id'] == $category['category_id']){
                                                ?>
                                                <div class="scroll-item">
                                                    <div class="product">
                                                    <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="Image" style="height:50%; width:100%;object-fit: fill;" />
                                                        <div class="product-description">
                                                            <h2><?= htmlspecialchars($product['name']) ?></h2>
                                                                
                                                            <div class="product_details">
                                                                <span><?= htmlspecialchars($product['description']) ?></span>
                                                                <br>
                                                                <span>$<?= number_format($product['price'], 2) ?></span>
                                                                <br>
                                                                <button class="add-to-cart" onclick="addToCart('<?php echo $product['product_id']?>')">Add To Cart</button>
                                                            </div>
                                                        
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                        <?php
                                            }
                                        }
                                        
                                    ?>
                                <button class="arrow right-arrow" onclick="scrollRowRight(500,'<?php echo $category['name'].'row' ?>')">→</button>     
                                </div>
                            </div>

                    <?php endforeach ?>
                    <?php else: ?>
                        <p>No products available in the store.<br>Our sincerest apologies</p>
                    <?php endif; ?>

                </div>
                <?php require("Resources\\Views\\Public\\footer.php");?>
            </div>
            
        </body>

  
        </html>
        <?php
    }
}
