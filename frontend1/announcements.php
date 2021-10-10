<?php
session_start();
// get the user id from session

$userId = $_SESSION['user_id'];
require_once('../backend/config.php');
require_once('../backend/announcement_utils.php');







if(isset($_POST['announcement'])){

$values = array(
  'user_id' => $_SESSION['user_id'],
  'body' => $_POST['announcement']
);
$error =   createAnnouncementSQL($values);

if(!$error){
  echo "Announcement Has Been Posted";
}
}

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- FontAwesome CSS-->
    <script src="https://kit.fontawesome.com/a72b2bc306.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/styles.css">

    <title>DEC BOOK</title>
</head>


<body>
  <div class="container">
    <?php include('header.php')?>
    <div class="profileMain">

        <div id="ann_div" class="announcements">
                <textarea name="announcement" id="announcement" placeholder="Post an announcement" rows="5" cols="50" required></textarea>
                <input type="hidden" name="" id="userId" value="<?php echo  $userId ?>">
                <button id="submit_btn" type="submit">Submit</button>


        </div>

    </div>

    <?php


    if(isset($_GET['user'])){

      $user = $_GET['user'];
    $results = getAnnouncementsByUserId($user);


    echo " <h1 id='title'>Announcements By: " .$user . "</h1>";
    foreach($results as $result){

      echo  "<div class='profileSearch'>".

                  "<h4>Announcement:</h4>".
                  "<p>". $result['body']. "</p>".
                  "<h4>Date:".$result['created_at']. "</h4>".
              "</div>";
    }




}


     ?>
  </div>






    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>

    <script src="js/main.js"></script>
</body>


</html>
