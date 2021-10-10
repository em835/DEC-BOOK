<?php
require_once("../backend/config.php");

require_once("../backend/user_utils.php");

$LOGIN_STATUS = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
        //checking if request
      // print_r($_POST);
      // collect value of input field
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username)){
      throw new Exception("No Username");
    }

    if(empty($password)){
      throw new Exception("No Password");
    }
    $db_user = requestByUsernameSQL($username);

    if(empty($db_user)){
      throw new Exception("No User Found with name \"$username\"");
    }
    if($db_user["password"] != $password){
      throw new Exception("User's password is incorrect");
    }
    // Start the session
    session_start();
    // Set session variables
    $_SESSION["username"] = $username;
    $_SESSION['user_id'] = $db_user['user_id'];
    redirect("./search.php");
    die();
  }catch(Exception $e){
    $LOGIN_STATUS = $e->getMessage();
  }
}
