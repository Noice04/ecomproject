<?php

    namespace controllers;

    use database\dbUser;

    class DbuserController{

        private $user;

        public function read(){
            $user = new dbUser();
            $user->createUser();
            $user->grantPrivileges();
            

            (new EmployeeList())->render($data);
    
            // Another option is to remove the echo from the view Just return HTML
            // then the controller returns the view as the requested resource
            // and it will be written to the response's body 
            // If we used return in the view then we can return the data
           //return  (new EmployeeList())->render($data);
        }
        
    }

?>