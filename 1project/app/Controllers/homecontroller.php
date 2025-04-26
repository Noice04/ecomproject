<?php

    namespace controllers;

    use models\Home;
    use views\HomePage;
    use models\Product;

    require(dirname(__DIR__)."/models/home.php");
    require(dirname(__DIR__)."/resources/views/public/homepage.php");

    class HomeController{

        private Home $home;

        public function read(){
            $home = new Home();
            $products = $home->getProducts();

            $categories = $home->getCategories();
            
            (new HomePage())->render($products,$categories); 
        }
    }


?>