<?php

namespace database;

use DBConnectionManager;

class dbUser{

    private $dbmanager;
    private $user;
    private $password;

    __construct(){

        $this->dbConnection = (new DBConnectionManager())->getConnection();
        $this->user = 'webapp_user'@'localhost';
        $this->password = 'StrongPassword123!';

    }

    function createUser(){
        $query = 'CREATE USER '.$user.' 
        IDENTIFIED BY '.$password.';';
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute();

    }

    function grantPrivileges(){
        $query = 'GRANT SELECT, INSERT, UPDATE, DELETE 
        ON hr.* TO '.$password.';';
        $stmt = $this->dbConnection->prepare($query);
        $stmt->execute();
        $stmt = $this->dbConnection->prepare("FLUSH PRIVILEGES;");
        $stmt->execute();

        
    }





}


?>