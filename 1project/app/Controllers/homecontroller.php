<?php

    namespace controllers;

    use models\Home;
    use views\HomePage;
    use models\Product;
    use views\LoginPage;

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
        
        public function create(){// currently this code is no longer necessary
            $home = new Home();
            if(isset($_POST['action'])){//
                if($_POST['action']=="logins"){
                    echo "noice";
                    //header("location:logins");
                    echo "noice";
                }
                else{
                    header("location:registers");
                }
            }

        }

    }


?>