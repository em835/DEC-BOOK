<?php
require_once("../backend/config.php");

require_once("../backend/user_utils.php");

require_once("../backend/announcement_utils.php");

$user = ensureUserSession();


$FORM_STATUS = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
    if(empty($_POST)){
      throw new Exception("empty post");
    }

    if(empty($_POST["announcement"])){
      throw new Exception("empty post");
    }
    $post = array();
    $post["body"] = $_POST["announcement"];
    $post["user_id"] = $user["user_id"];
    createAnnouncementSQL($post);
  }catch(Exception $e){
    $FORM_STATUS = $e->getMessage();
  }
}
