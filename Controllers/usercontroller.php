<?php

namespace controllers;

use views\UserRegister;
use models\UserModel; // Assuming this exists
use helpers\InputSanitizer;

class UserController {

    public function register() {
        $view = new UserRegister();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = InputSanitizer::sanitize($_POST['username']);
            $password = InputSanitizer::sanitize($_POST['password']);
            $enabled2FA = isset($_POST['enabled2FA']) ? (int)$_POST['enabled2FA'] : 0;
            $secret = InputSanitizer::sanitize($_POST['secret']);

            $errors = [];

            if (empty($username) || empty($password)) {
                $errors[] = "Username and password are required.";
            }

            if (empty($errors)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $userModel = new UserModel();
                $userModel->createUser($username, $hashedPassword, $enabled2FA, $secret);

                header("Location: /app/logins");
                exit();
            } else {
                $view->render($errors);
            }

        } else {
            $view->render();
        }
    }
}
