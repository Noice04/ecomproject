<?php

namespace controllers;

use views\public\Login;
use EmployeeController;


require(dirname(__DIR__)."/resources/views/public/login.php");

class LoginController{

     
    public function read(){
        
        $data =null;

        (new Login())->render($data);
    
    }    

    public function create($data){

        /*if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = InputSanitizer::sanitize($_POST['username']);
            $password = InputSanitizer::sanitize($_POST['password']);
        */
        (new Login())->render($data);
    
    //}

    }
}