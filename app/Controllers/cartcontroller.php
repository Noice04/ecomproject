<?php

    namespace controllers;

    use models\Cart;
    use models\Product;
    use views\CartList;
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    require(dirname(__DIR__)."/models/cart.php");
    require(dirname(__DIR__)."/models/product.php");
    require(dirname(__DIR__)."/resources/views/carts/cartslist.php");

    class CartController{

        private Product $product;
        private Cart $cart;
        private Logger $logger;

        public function __construct() {
        $this->logger = new Logger('cart');
        $this->logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/cart.log', Logger::INFO));
        }

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
                    $this->logger->info("User ".$_SESSION['user_id']." added product {".$data['product_id']."} to their cart.");
                    break;
                case "increaseOne":
                    $cart->updateQuantity($data['item_cart_id'],1);
                    $this->logger->info("User ".$_SESSION['user_id']." increased the quantity of {".$data['product_id']."} in their cart by 1.");
                    $this->read();
                    break;
                case "reduceOne":
                    $cart->updateQuantity($data['item_cart_id'],-1);
                    $this->logger->info("User ".$_SESSION['user_id']." decreased the quantity of {".$data['product_id']."} in their cart by 1.");
                    $this->read();
                    break;
                case "removeItem":
                    $cart->removeItem($data['item_cart_id']);
                    $this->logger->info("User ".$_SESSION['user_id']." removed product {".$data['product_id']."} from their cart.");
                    $this->read();
                    break;
                case "confirmOrder":
                    $cart->removeItem($data['item_cart_id']);// needs to be made
                    $this->logger->info("User ".$_SESSION['user_id']." has emptied their cart and created an order");
                    $this->read();
                    break;
                default: //perfect spot for a 404 not found error and then sending the user back to the home page
            }
            
        }


    }


?>