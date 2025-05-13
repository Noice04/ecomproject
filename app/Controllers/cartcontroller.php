<?php

    namespace controllers;

    use models\Cart;
    use models\Product;

    require(dirname(__DIR__)."/models/cart.php");
    require(dirname(__DIR__)."/models/product.php");
    require(dirname(__DIR__)."/resources/views/carts/cartlist.php");

    class CartController{

        private Product $product;
        private Cart $cart;

        public function read(){
            

            $cart = new Cart();
            $data = $cart->read();
            (new CartList())->render($data); 

        }
        public function create($data){
            $product = new Product();
            $proddata = $product->readByCategory($data['selectedcategory']);
            $category = $product->getCategoryName($data['selectedcategory']);
            (new ProductListCategory())->render($proddata,$category[0]['name']); 
        }


    }


?>