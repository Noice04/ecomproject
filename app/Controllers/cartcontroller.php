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
            switch ($data['action']){
                case "addToCart":
                    $cart->addToCart($_SESSION['user_id'],$data['product_id'],$data['quantity']);
                    break;
                case "increaseOne":
                    $cart->updateQuantity($data['item_cart_id'],1);
                    $this->read();
                    break;
                case "reduceOne":
                    $cart->updateQuantity($data['item_cart_id'],-1);
                    $this->read();
                    break;
                case "removeItem":
                    $cart->removeItem($data['item_cart_id']);
                    $this->read();
                    break;
                default: //perfect spot for a 404 not found error and then sending the user back to the home page
            }
            
        }


    }


?>