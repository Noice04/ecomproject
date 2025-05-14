<?php

namespace models;

use database\DBConnectionManager;
use models\User;

require(dirname(__DIR__)."/models/user.php");
require_once(dirname(__DIR__)."/core/db/dbconnectionmanager.php");

class Login{

    private $username;
    private $password;
    private $dbConnection;
    

    // Constructor
    public function __construct() {

        $this->dbConnection = (new DBConnectionManager())->getConnection();
         
    }

    public function getUserSecretbyID($userId){
        $query = "SELECT twofa_secret FROM user WHERE user_id = :userid";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':userid',  $userId);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function login($data) {
        
        $query = "SELECT * FROM user WHERE username = :username";
        $stmt = $this->dbConnection->prepare($query);
        $stmt->bindParam(':username',  $data['username']);
        $stmt->execute();
        $datadb = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $datadb;
    }
        //if(!empty($datadb)){

          
            /*
            //cant get the password_verify to work for some reason
        if(password_verify($data['password'],$datadb[0]['password'])){
            session_start();
            $_SESSION['user_id'] = $datadb[0]['user_id'];
            $_SESSION['username'] = $datadb[0]['username'];


            return $datadb[0];
        }
        else{
           

            return false;
        }*/
    //}

    //return false;


    
}