<?php

    namespace controllers;

    use models\Order;
    use models\Cart;
    use views\OrderList;
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    require(dirname(__DIR__)."/models/cart.php");
    require(dirname(__DIR__)."/models/order.php");
    require(dirname(__DIR__)."/resources/views/orders/orderlist.php");

    class OrderController{

        private Order $order;
        private Cart $cart;
        private Logger $logger;

        public function __construct() {
            $this->logger = new Logger('order');
            $this->logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/order.log', Logger::INFO));
        }
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
            switch ($data['action']){//just realized i made a mistake here since i copy pasted the cart which had a switch i just kept it like this
                case "confirmOrder":
                    $orderID = $order->createOrder($_SESSION['user_id'],$data['total_price']);
                    //gotta add all cart items to the order_item table
                    $cartItems = $cart->getCartItems($_SESSION['user_id']);
                    foreach($cartItems as $item){
                        $order->addOrderItem($orderID, $item['product_id'], $item['quantity'], $item['price']);
                         $this->logger->info("User ".$_SESSION['user_id']." added ".$item['product_id']."to his order ".$orderID);
                    }
                    $cart->clearCart($_SESSION['user_id']);
                    $this->logger->info("User ".$_SESSION['user_id']." has cleared his cart of all items and created an order");
                    $this->read();
                    break;
                
                
                default: 

                
            }
            
        }


    }


?>