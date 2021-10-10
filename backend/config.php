<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);





// define('SQL_HOST', $server);
// define('SQL_USER', $user);
// define('SQL_PASS', $password);
// define('SQL_DB',   $database);

function createSQLConnection(){
  //connect to the Database
//$dbServername = "sql1.njit.edu";
//$dbUsername = "cll27@webhost01.arcs.njit.edu";
//$dbPassword = "Daniela6??";
//$dbName = "cll27";

// $servername = "sql1.njit.edu";
// $username = "cll27@webhost01.arcs.njit.edu";
// $password = " Daniela6??";
// $dbname = "cll27";

$server = "127.0.0.1";
$user= "root"; 
$password = "password";
$database = "project_master";

  $conn = mysqli_connect(
   $server,
    $user,
    $password,
    $database
  );

  // Check connection
  if (!$conn) {
    die('Error'+ mysqli_error($conn)); 
  }
  else{
    //echo "connected";
  }

  if (mysqli_connect_errno()){
    throw new Exception("Failed to connect to MySQL: " . mysqli_connect_error());
  }

  return $conn;
}

function redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    die();
}


function clearSession(){
  session_start();

  // Unset all of the session variables.
  $_SESSION = array();

  // If it's desired to kill the session, also delete the session cookie.
  // Note: This will destroy the session, and not just the session data!
  if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000,
          $params["path"], $params["domain"],
          $params["secure"], $params["httponly"]
      );
  }

  // Finally, destroy the session.
  session_destroy();

}
