<?php

    namespace controllers;

    use models\User;
    use views\UserList;

    require(dirname(__DIR__)."/models/user.php");
    require(dirname(__DIR__)."/resources/views/users/userslist.php");

    class UserController{

        private User $user;

        public function read(){
            
            $user = new User();
            $data = $user->read();
            (new UserList())->render($data); 
        }
    }


?>