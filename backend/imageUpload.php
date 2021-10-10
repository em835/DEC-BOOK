<?php
require("config.php");

  $userId = (int) $_POST['userId'];
  $image =  $_POST['userImage'];
  
  $statement = "UPDATE user SET user_image = '$image' WHERE user_id='$userId'";
  $conn = createSQLConnection();
  $result = mysqli_query($conn, $statement);

  if(!$result){
    die('Error'+ mysqli_error($conn)); 

  }else{
    echo "Image Uplaoded";
  }



?>