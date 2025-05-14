<?php

    namespace controllers;

    use models\Cart;
    use models\Product;
    use views\CartList;

    require(dirname(__DIR__)."/models/cart.php");
    require(dirname(__DIR__)."/models/product.php");
    require(dirname(__DIR__)."/resources/views/carts/cartslist.php");

    class CartController{

        private Product $product;
        private Cart $cart;

        public function read(){
            

            $cart = new Cart();
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $data = $cart->getCartItems($_SESSION['user_id']);
            (new CartList())->render($data); 

        }
        public function create($data){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $cart = new Cart();
            $cart->addToCart($_SESSION['user_id'],$data['product_id'],$data['quantity']);
        }


    }


?>