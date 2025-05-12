<?php

namespace controllers;

use models\Register;
use views\RegisterPage;

require(dirname(__DIR__)."/models/register.php");
require(dirname(__DIR__)."/resources/views/public/registerpage.php");

class RegisterController {

    private Register $register;

    public function read() {
        (new RegisterPage())->render();
    }

    public function create($data) {
        $register = new Register();
        $success = $register->register($data);

        if ($success) {
            header('Location: logins'); // After successful registration, go to login page
        } else {
            header('Location: registers'); // Stay on register page if failed
        }
    }

}
