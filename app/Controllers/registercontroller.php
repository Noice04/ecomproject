<?php

namespace controllers;

use models\Register;
use views\RegisterPage;
use views\RegisterPageSuccess;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require(dirname(__DIR__)."/models/register.php");
require(dirname(__DIR__)."/resources/views/public/registerpage.php");
require(dirname(__DIR__)."/resources/views/2fa/registerpagesuccess.php");

class RegisterController {

    private Register $register;
    private Logger $logger;

    public function __construct() {
        $this->logger = new Logger('register');
        $this->logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/register.log', Logger::INFO));
    }
    public function read() {
        $this->logger->info("User has opened the register page");
        (new RegisterPage())->render();
    }

    public function create($data) {
        $register = new Register();
        $success = $register->register($data);

        if ($success) {
            $this->logger->info("User ".$success['temp_user_id']." has successfully registered");
            (new RegisterPageSuccess())->render(); // After successful registration, go to login page
        } else {
            $this->logger->info("User has failed to register");
            header('Location: registers'); // Stay on register page if failed
        }
    }

}
