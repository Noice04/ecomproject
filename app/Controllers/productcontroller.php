<?php

    namespace controllers;

    use models\Product;
    use views\ProductList;
    use views\ProductListCategory;
    use Monolog\Logger;
    use Monolog\Handler\StreamHandler;

    require(dirname(__DIR__)."/models/product.php");
    require(dirname(__DIR__)."/resources/views/products/productlist.php");
    require(dirname(__DIR__)."/resources/views/products/productlistcategory.php");

    class ProductController{

        private Products $product;
        private Logger $logger;

        public function __construct() {
            $this->logger = new Logger('product');
            $this->logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/product.log', Logger::INFO));
        }
        public function read(){
            if(session_status()===PHP_SESSION_NONE){
                session_start();
            }
            if(isset($_GET['search'])){
                $product = new Product();
                $data = $product->search($_GET['search']);
                $categories = $product->getCategories();
                (new ProductList())->render($data,$categories); 
                exit;
            }

            if(isset($_SESSION['user_id']))
            $this->logger->info("User ".$_SESSION['user_id']." opened the products page");
            else{
                $this->logger->info("A guest opened the products page");
            }
            
            $product = new Product();
            $data = $product->read();
            $categories = $product->getCategories();
            (new ProductList())->render($data,$categories); 

        }
        public function create($data){
            if(isset($data['allproducts']))
                $this->read();

            $product = new Product();
            $proddata = $product->readByCategory($data['selectedcategory']);
            $category = $product->getCategoryName($data['selectedcategory']);
            $categories = $product->getCategories();
            if(session_status()===PHP_SESSION_NONE){
                session_start();
            }
            if(isset($_SESSION['user_id']))
            $this->logger->info("User ".$_SESSION['user_id']." opened the products page on ".$category[0]['name']." page");
            else{
                $this->logger->info("A guest opened the products page on ".$category[0]['name']." page");
            }
            (new ProductListCategory())->render($proddata,$category[0]['name'],$data['page'] ?? 0, $categories); 
        }


    }


?>