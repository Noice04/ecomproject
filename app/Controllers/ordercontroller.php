<?php

    namespace controllers;

    use models\Order;
    use models\Cart;
    use views\OrderList;

    require(dirname(__DIR__)."/models/cart.php");
    require(dirname(__DIR__)."/models/order.php");
    require(dirname(__DIR__)."/resources/views/orders/orderlist.php");

    class OrderController{

        private Order $order;
        private Cart $cart;

        public function read(){
            

            $order = new Order();
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $data = $order->getOrdersByUser($_SESSION['user_id']);
            (new OrderList())->render($data); 

        }


        public function create($data){
            
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $order = new Order();
            $cart = new Cart();
            switch ($data['action']){
                case "confirmOrder":
                    $orderID = $order->createOrder($_SESSION['user_id'],$data['total_price']);
                    //gotta add all cart items to the order_item table
                    $cartItems = $cart->getCartItems($_SESSION['user_id']);
                    foreach($cartItems as $item){
                        $order->addOrderItem($orderID, $item['product_id'], $item['quantity'], $item['price']);
                    }
                    $cart->clearCart($_SESSION['user_id']);
                    $this->read();
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
                case "confirmOrder":
                    $cart->removeItem($data['item_cart_id']);// needs to be made
                    $this->read();
                    break;
                default: //perfect spot for a 404 not found error and then sending the user back to the home page
            }
            
        }


    }


?>