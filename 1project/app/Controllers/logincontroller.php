<?php

namespace controllers;



use models\Login;
use views\LoginPage;
use views\Home;

require(dirname(__DIR__)."/models/login.php");
require(dirname(__DIR__)."/resources/views/public/loginpage.php");

class LoginController{

    private Login $login;

    public function read(){  

        (new LoginPage())->render(); 
    }
    public function create($data){

        $login = new Login($data);
        $data = $login->login();
        session_start();
        if(isset($_SESSION['user_id'])){

            header("location: homes");


        }else{
            (new LoginPage())->render();
        }
        
            
        }

    
}