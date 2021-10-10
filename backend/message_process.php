<?php


if(isset($_POST['send_message'])){
  
  $senderId = $_POST['senderId'];
  $recieverId = $_POST['recieverId'];
  $messageText = $_POST['messageText'];

   $values = array(
    'sender_id' => $senderId, 
    'reciever_id' => $recieverId, 
    'message' => $messageText
  );
  require('message_utils.php'); 
  $result = sendMessage($values);
  echo $result;
  
}


?>