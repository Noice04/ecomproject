<?php

namespace controllers;



use models\Login;
use views\LoginPage;
use views\LoginPage2fa;
use views\Home;

require(dirname(__DIR__)."/models/login.php");
require(dirname(__DIR__)."/resources/views/public/loginpage.php");
require(dirname(__DIR__)."/resources/views/2fa/loginpage2fa.php");

class LoginController{

    private Login $login;

    public function read(){  

        (new LoginPage())->render(); 
    }
    public function create($data){
        

        $login = new Login($data);
        var_dump($data);
        /*

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        //this checks if the user inputed the correct password

        if (!isset($data['secret'])){
            $datadb = $login->login($data);//gets the db password 
            if(password_verify($data['password'],$datadb[0]['password'])){ 
                $_SESSION['tempuser_id'] = $datadb[0]['user_id'];
                (new LoginPage2fa())->render();

            }
        }
        else{
            //compare secrets
            $userSecret = $login->getUserSecretbyID($_SESSION['tempuser_id']);
            unset($_SESSION['tempuser_id']);
            $totp = TOTP::create($userSecret); // from your database
            if ($totp->verify($data['secret'])) {
                header("location:homes");
            } else {
                echo "❌ Invalid code.";
            }
        }
        header("location:registers");
    }
    */
}

/*
//fucked
        if(isset($_SESSION['user_id'])){
            if(isset($data['secret'])){
                var_dump($data);
                //get User Secret
                $userSecret = $login->getUserSecretbyID($_SESSION['user_id']);
                $totp = TOTP::create();
                //$totp = TOTP::create($dbsecret);
            }
            else
            (new LoginPage2fa())->render();

        }else{
            (new LoginPage())->render();
        }//
        
            
        }

    
}
        */
}