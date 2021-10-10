<?php
require_once("config.php");

//squl also creating a user
function sendMessage($values){



  $statement = "
    INSERT INTO messages (sender_id, reciever_id, message_body, created_at)
    VALUES ('".$values["sender_id"]."', '".$values["reciever_id"]."',
    '".$values["message"]."',
    CURRENT_TIME());
  ";

  $conn = createSQLConnection();



  if (!mysqli_query($conn, $statement)) {
    throw new Error(mysqli_error($conn));
  }

  mysqli_close($conn);

}



function getUserMessages($user){
  $conn = createSQLConnection();

  $user = (int) $user;
  $searchUsername = mysqli_real_escape_string($conn, $user);

  $statement = "SELECT DISTINCT user.user_id, user.userName, messages.reciever_id, messages.sender_id, messages.message_body FROM user JOIN messages ON user.user_id = messages.sender_id WHERE (user.user_id <> '$user' AND (messages.reciever_id = '$user' OR messages.sender_id = '$user'))
  ";

  $result = mysqli_query($conn, $statement);
  if (!$result) {
    mysqli_close($conn);
    throw new Exception(mysqli_error($conn));
  }


  $num_rows = mysqli_num_rows($result);
  if ($num_rows == 0) {
    return [];
    mysqli_close($conn);
  }
  $rows = [];
  while($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
  }
  mysqli_close($conn);

 // var_dump($rows);
  return $rows;

}


function readMessage($id){
  $id = (int)$id;


  $conn = createSQLConnection();

  $messageId = mysqli_real_escape_string($conn, $id);

  $statement = "SELECT DISTINCT user.user_id, user.userName, messages.reciever_id, messages.sender_id, messages.message_body, messages.created_at FROM user JOIN messages ON user.user_id = messages.sender_id WHERE (messages.sender_id = '$id' OR messages.reciever_id='$id')
  ";

  $result = mysqli_query($conn, $statement);
  if (!$result) {
    throw new Exception(mysqli_error($conn));
    mysqli_close($conn);
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



?>
