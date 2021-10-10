<?php

require_once("config.php");

function validateCreateUserValues($values){
  if(empty($values)){
    throw new Exception("Nothing to create");
  }
  if(empty($values["firstName"])){
    throw new Exception("No First Name");
  }
  if(empty($values["lastName"])){
    throw new Exception("No Last Name");
  }
  if(empty($values["userName"])){
    throw new Exception("No User Name");
  }
  if(empty($values["password"])){
    throw new Exception("No Password");
  }

}

//using sql creating a user
function requestByUsernameSQL($username){
if(isset($_POST)){
  
  $conn = createSQLConnection();

  $searchUsername = mysqli_real_escape_string($conn, $username);

  $statement = "
    SELECT * FROM user
    WHERE username = '$searchUsername'
  ";

  $result = mysqli_query($conn, $statement);
  if (!$result) {
    mysqli_close($conn);
    throw new Exception(mysqli_error($conn));
  }


  $num_rows = mysqli_num_rows($result);
  if ($num_rows == 0) {
    mysqli_close($conn);
    // throw new Exception("0 result found");
  }
  if($num_rows > 1){
    mysqli_close($conn);
    throw new Exception("more than 1 result found");
  }
  $row = mysqli_fetch_assoc($result);

  
  return $row;
  mysqli_close($conn);
}
}
//squl also creating a user
function createUserSQL($values){
  validateCreateUserValues($values);

  $statement = "
    INSERT INTO user (firstName, lastName, username, password)
    VALUES ('".$values["firstName"]."', '".$values["lastName"]."', '".$values["userName"]."', '".$values["password"]."');
  ";

  $conn = createSQLConnection();

  if (!mysqli_query($conn, $statement)) {
    throw new Error(mysqli_error($conn));
  }

  mysqli_close($conn);

  return requestByUsernameSQL($values["userName"]);

}


function getListOfUsersLike($likeString){
  $conn = createSQLConnection();

  $searchUsername = mysqli_real_escape_string($conn, $likeString);

  $statement = "
    SELECT * FROM user
    WHERE userName LIKE '$searchUsername%';
  ";

  $result = mysqli_query($conn, $statement);
  if (!$result) {
    mysqli_close($conn);
    throw new Exception(mysqli_error($conn));
  }


  $num_rows = mysqli_num_rows($result);
  if ($num_rows == 0) {
    mysqli_close($conn);
    return [];
  }
  $rows = [];
  while($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
  }
  mysqli_close($conn);

  return $rows;
}

function ensureUserSession(){
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  $username = $_SESSION["username"];
  if(empty($username)){
    redirect("./login.php");
  }
  $user = requestByUsernameSQL($username);
  if(empty($user)){
    redirect("./login.php");
  }
  return $user;
}
