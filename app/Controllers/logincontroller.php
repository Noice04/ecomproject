<?php

namespace controllers;



use OTPHP\TOTP;
use models\Login;
use views\LoginPage;
use views\LoginPage2fa;
use views\Home;

require 'vendor/autoload.php';
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
        //var_dump($data);
        

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($data['action'])){
            if($data['action']=='logout'){
                session_unset();
                header("location:homes");
            }
        }

//this checks if the user inputed the correct password
        if (!isset($data['secret'])){
            $datadb = $login->login($data);//gets the db password 
            if(password_verify($data['password'],$datadb[0]['password'])){ 
                $_SESSION['tempuser_id'] = $datadb[0]['user_id'];
                $_SESSION['tempusername'] = $datadb[0]['username'];
                (new LoginPage2fa())->render();

            }
        }
        else{
            //compare secrets
            $userSecret = $login->getUserSecretbyID($_SESSION['tempuser_id']);
            $totp = TOTP::create($userSecret[0]['twofa_secret']); // from your database
            if ($totp->verify($data['secret'])) {
                $_SESSION['user_id'] = $_SESSION['tempuser_id'];
                $_SESSION['username'] = $_SESSION['tempusername'];
                unset($_SESSION['tempuser_id']);
                unset($_SESSION['tempusername']);
                header("location:homes");
            } else {
                unset($_SESSION['tempuser_id']);
                (new LoginPage())->render("secondtry");
            }
        }
    }
    
}

/*
//broken to be fixed
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
