<?php

    namespace controllers;

    use models\Home;
    use views\HomePage;

    require(dirname(__DIR__)."/models/home.php");
    require(dirname(__DIR__)."/resources/views/public/homepage.php");

    class HomeController{

        private Home $home;

        public function read(){
            $home = new Home();
            $data = $home->read();
            (new HomePage())->render($data); 
        }
    }


?>