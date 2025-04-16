<?php

    namespace controllers;

    use models\Product;
    use views\ProductList;

    require(dirname(__DIR__)."/models/product.php");
    require(dirname(__DIR__)."/resources/views/products/productlist.php");

    class ProductController{

        private Products $product;

        public function read(){
            $product = new Product();
            $data = $product->read();
            (new ProductList())->render($data); 
        }
    }


?>