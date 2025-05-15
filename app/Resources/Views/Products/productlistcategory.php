<?php

namespace views;

class ProductListCategory {

    public function render($products, $categoryName,$page =0) {

        require("Resources\\Views\\Public\\header.php");
        ?>
        <!DOCTYPE html>
        <html>
             
        <head>
            
            <title><?= htmlspecialchars($categoryName) ?> Products</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background: #f8f8f8;
                }

                .container {
                    margin-left: 220px;
                    padding: 20px;
                    width: calc(100% - 220px);
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
                }

                .product-grid {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    flex-wrap: wrap;
                    gap: 20px;
                    justify-content: flex-start;
                    
                }

                .product {
                    flex: 1 1 calc(25% - 20px); /* 4 per row with gap */
                    min-width: 200px;
                    max-width: 100%;
                    background: #fff;
                    border-radius: 15px;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                    padding: 10px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    height: 400px;
                    overflow: hidden;
                }

                .product img {
                    width: 100%;
                    height: 50%;
                    object-fit: cover;
                    border-radius: 10px;
                }

                .product-description {
                    text-align: center;
                    margin-top: 10px;
                }

                .add-to-cart {
                    background-color: #157347;
                    color: white;
                    border: none;
                    padding: 10px 16px;
                    border-radius: 8px;
                    font-weight: bold;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                    margin-top: auto;
                }

                .pagination {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    gap: 5px; 
                    margin-top: 20px;
                }
                .pagination form {
                    display: inline; 
                }

                .pagination button {
                    padding: 10px 20px;
                    margin: 0 5px;
                    border: none;
                    background-color: #157347;
                    color: white;
                    border-radius: 5px;
                    cursor: pointer;
                    font-weight: bold;
                }

                h1, h2 {
                    margin-top: 0;
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

            </style>

            <script>
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
                function nextPage() {
                    if ((currentPage + 1) * productsPerPage < products.length) {
                        currentPage++;
                        renderProducts();
                    }
                }

                function prevPage() {
                    if (currentPage > 0) {
                        currentPage--;
                        renderProducts();
                    }
                }
            </script>
        </head>
        <?php
            $currentPage = $page;
            $productsPerPage = 15;
            $totalProducts = count($products);
            $start = $currentPage * $productsPerPage;
            $pageProducts = array_slice($products, $start, $productsPerPage);
        ?>
        <body>
            <div class="left-fixed-panel">
                <form action="" method="POST">
                    <button type="submit" name="selectedcategory" value="1">Dairy</button><br>
                    <button type="submit" name="selectedcategory" value="2">Baked Goods</button><br>
                    <button type="submit" name="selectedcategory" value="3">Fruits</button><br>
                    <button type="submit" name="selectedcategory" value="4">Meats</button><br>
                </form>
                <form action="" method="GET">
                    <button type="submit">All Products</button>
                </form>
            </div>

            <div class="container">
                <div class="title" style="padding-top: 60px;">
                    <h1>Our <?= htmlspecialchars($categoryName) ?> Products</h1>
                </div>
                <div class="product-grid">
                    <?php foreach ($pageProducts as $product): ?>
                        <div class="product">
                            <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="Image" />
                            <div class="product-description">
                                <h3><?= htmlspecialchars($product['name']) ?></h3>
                                <p><?= htmlspecialchars($product['description']) ?></p>
                                <strong>$<?= number_format((float)$product['price'], 2) ?></strong><br>
                                <button class="add-to-cart" onclick="addToCart('<?= $product['product_id'] ?>', 1)">Add To Cart</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                

                <div class="pagination">
                    <?php if ($currentPage > 0): ?>
                        <form action="products"method="POST">
                            <input type="hidden"name="selectedcategory"value=<?=$products[0]['category_id']?>>
                            
                            <button type="submit" name="page"value=<?=$currentPage-1?>>Previous</button>
                        
                        </form>
                        
                    <?php endif; ?>

                    <span id="page-number"><?= $currentPage + 1 ?></span>

                    <?php if (($currentPage + 1) * $productsPerPage < $totalProducts): ?>
                        <form action="products"method="POST">
                            <input type="hidden"name="selectedcategory"value=<?=$products[0]['category_id']?>>
                            
                            <button type="submit" name="page"value=<?=$currentPage+1?>>Next</button>
                        
                        </form>
                        
                    <?php endif; ?>
                </div>

            </div>
        </body>
         <?php require("Resources\\Views\\Public\\footer.php");?>
        </html>
        <?php
    }
}
