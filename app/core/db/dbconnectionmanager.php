<?php

namespace database;

class DBConnectionManager{

    private $username;
    private $password; // password to be stored and read through an environment variable
    private $server; 
    private $dbname;

    private $dbConnection;

    function __construct(){

        $this->username = $_ENV["DBUSERNAME"]; 
        $this->password = $_ENV["DBPASSWORD"];
        $this->server = $_ENV["DBSERVER"];
        $this->dbname = $_ENV["DBNAME"];

        try{
        
            //$this->dbConnection = new \PDO($_ENV["DB_URL"]);

            $this->dbConnection = new \PDO("mysql:host=$this->server;dbname=$this->dbname", $this->username, $this->password);

        }catch(\PDOException $e){
            print "Error!: " . $e->getMessage() . "<br/>";
        }
    }

    // could be a static function
    function getConnection(){

        return $this->dbConnection;

    }   
    
}