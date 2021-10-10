<?php
class users {
  private $id; 
  private $name; 
  private $email; 
  private $loginStatus; 
  private $lastLogin; 
  private $dbConn; 


  // create getter and setter functions 
  function setId($id){ $this->id = $id; }
  function getId() { return $this->id;}
  function setName($name){ $this->name= $name;}
  function getName(){return $this->name; }
  function setEmail($email){ $this->email = $email; }
  function getEmail(){return $this->email;}
  function setLoginStatus($loginStatus){$this->loginStatus = $loginStatus;}
  function getLoginStatus(){return $this->loginStatus;}
  function setLastLogin($lastLogin){$this->lastLogin = $lastLogin; }
  function getLastLogin(){return $this->lastLogin;}
  
  // create the constructor function 
  public function __construct(){
    require_once('DbConnect.php');
    $db = new DbConnect();
    $this->dbConn = $db->connect();


  }

  // function to save data
  public function save(){
   
    $sql = "INSERT INTO user(username, email, login_status, last_login)
    VALUES(:username, :email, :loginStatus, :lastLogin)"; 
    // prepare the statement 
    $stmt = $this->dbConn->prepare($sql);

   
    // bind the parameters to be saved 
    $stmt->bindParam(":username", $this->name); 
    $stmt->bindParam(":email", $this->email); 
    $stmt->bindParam(":loginStatus", $this->loginStatus); 
    $stmt->bindParam(":lastLogin", $this->lastLogin); 

    // finally, execute the query
    try {
      //code...
      if($stmt->execute()){
        return true;
      }else{
        return false; 
      }
    } catch (Exception $e) {
      
      echo $e->getMessage();
    }

  }

  // function to check if user already exists 
  public function getUserByEmail(){
    $sql = "SELECT * FROM user WHERE email=:email";
    $stmt = $this->dbConn->prepare($sql);
    $stmt->bindParam(':email', $this->email);

    try {
      if($stmt->execute()){
        $user= $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;

      }
    } catch (Exception $e) {
      echo $e->getMessage();
      
    }
  }

  public function getUserById(){
    $sql = "SELECT * FROM user WHERE user_id=:id";
    
    $stmt = $this->dbConn->prepare($sql);
    $stmt->bindParam(':id', $this->id);

    try {
      if($stmt->execute()){
        $user= $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;

      }
    } catch (Exception $e) {
      echo $e->getMessage();
      
    }
  }

  public function updateLoginStatus(){
    $sql = "UPDATE user SET login_status =:loginStatus, last_login = :lastLogin WHERE id=:id";
    $stmt = $this->dbConn->prepare($sql);
    $stmt->bindParam(":loginStatus", $this->loginStatus);
    $stmt->bindParam(":lastLogin", $this->lastLogin);
    $stmt->bindParam(":id", $this->id);
    try {
      if($stmt->execute()){
        return true;
      }else{
        return false; 
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  // function to get all users 
  public function getAllUsers(){
    $sql = "SELECT * FROM user"; 
    $stmt = $this->dbConn->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users; 
  }



}