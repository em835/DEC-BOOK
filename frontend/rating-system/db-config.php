<?php

// $server = "127.0.0.1";
// $user= "root"; 
// $password = "password";
// $database = "project_master";



$server = "127.0.0.1";
$user= "root"; 
$password = "password";
$database = "project_master";

  $dbConnection = mysqli_connect(
     $server,
     $user,
     $password,
     $database
   );
  
?>
