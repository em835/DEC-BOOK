<?php
require_once("../backend/config.php");

require_once("../backend/user_utils.php");
$_REGISTER_STATUS = "";
  //checking if request
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try{
      $db_user = createUserSQL($_POST);
      if(!empty($_SESSION)){
        clearSession();
      }
      // Start the session
      session_start();
      // Set session variables
      $_SESSION["username"] = $db_user["userName"];
      redirect("./login.php");
      die();
    }catch(Exception $e){
      $_REGISTER_STATUS = $e->getMessage();
    }
  }
