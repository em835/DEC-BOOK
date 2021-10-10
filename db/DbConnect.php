<?php

require_once(__DIR__."/../backend/config.php");


$server = "localhost";
$user= "root"; 
$password = "password";
$database = "project_master";



  class DbConnect {
    private $host = 'localhost';
    private $dbName = 'project_master';
    private $user = 'root';
    private $pass = 'password';

    public function connect(){
      try {
        //code...
        $conn = new PDO('mysql:host='. $this->host . ';dbname=' .$this->dbName, $this->user, $this->pass );

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo 'connected';
        return $conn;
      } catch (PDOException $e) {

        //throw $e;
        echo 'Database Error: ' . $e->getMessage();
      }
    }
  }
