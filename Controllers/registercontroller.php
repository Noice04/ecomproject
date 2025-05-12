<?php

namespace controllers;

use views\public\Register;
use UserController;

require(dirname(__DIR__)."/resources/views/public/Register.php");

class RegisterController{

     
    public function read(){
        
        $data =null;

        (new Register())->render($data);
    
    }    

    public function create($data){

        (new Register())->render($data);
    
    }

}
