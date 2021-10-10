<?php


if(isset($_POST['submit_annoucement'])){
  $userId = $_POST['userId'];
  $body = $_POST['text'];

  $values = array(
    'user_id' => $userId, 
    'body' => $body
  );
  require('announcement_utils.php'); 
  $result = createAnnouncementSQL($values);
  echo $result;
  
}

if (isset($_POST['submit_comment'])){


  $userId = $_POST['userId'];
  $postId = $_POST['postId'];
  $comment = $_POST['comment'];

  $values = array(
    'user_id' => $userId, 
    'comment' => $comment, 
    'post_id' => $postId
  );
  
  require('announcement_utils.php'); 
  $result = addComment($values);
  echo $result;

}
?>